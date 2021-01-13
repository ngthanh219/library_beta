<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Auth;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function index()
    {
        $user = User::with(['requests' => function($query){
            $query->orderBy('id', 'desc');
        }])->findOrFail(Auth::id());

        return view('client.list_request', compact('user'));
    }

    public function show($id)
    {   
        $request = Request::with('user')->findOrFail($id);
        
        return view('client.detail_request', compact('request'));
    }

    public function cart()
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::get()->take(config('pagination.limit_author'));
        $cart = session()->get('cart');

        return view('client.cart', compact('categories', 'authors', 'cart'));
    }

    public function addToCart($id)
    {
        $cart = session()->get('cart');
        $book = Book::findOrFail($id);
        if ($book->in_stock == 0) {
            return response()->json([
                'message' => trans('request.out_of_stock'),
            ]);
        } else {
            if (empty($cart)) {
                $cart = [
                    $id => [
                        'id' => $id,
                        'image' => $book->image,
                        'name' => $book->name,
                    ],
                ];
                session()->put('cart', $cart);
                session()->save();

                return response()->json([
                    'message' => trans('request.add_cart'),
                ]);
            } else {
                if (isset($cart[$id])) {
                    return response()->json([
                        'message' => trans('request.add_only_book'),
                    ]);
                } else {
                    $cart[$id] = [
                        'id' => $id,
                        'image' => $book->image,
                        'name' => $book->name,
                    ];
                    session()->put('cart', $cart);
                    session()->save();

                    return response()->json([
                        'message' => trans('request.add_cart'),
                    ]);
                }
            }
        }
    }

    public function removeCart($id)
    {
        $cart = session()->get('cart');
        unset($cart[$id]);
        session()->put('cart', $cart);
        session()->save();

        return response()->json([
            'message' => trans('request.remove_from_cart'),
        ]);
    }

    public function request(OrderRequest $request)
    {
        $user = User::with(['requests.books', 'requests' => function ($query) {
            $query->where('status', '<>', 4)->where('status', '<>', 2)->withCount('books');
        }])->findOrFail(Auth::id());
        if ($user->status == 2) {
            return redirect()->route('cart')->with('mess', 'Bạn đã quá số lần cho phép quá hạn xin vui lòng trả sách cho lần mượn tiếp theo');
        }
        $totalBook = 0;
        $cart = session()->get('cart');
        if (!$user->requests->isEmpty()) {
            foreach ($user->requests as $req) {
                foreach ($cart as $item) {
                    $book = Book::findOrFail($item['id']);
                    if ($req->books->contains($book)) {
                        return redirect()->route('cart')->with('mess', trans('Ban da muon quyen sach nay roi'));
                    }
                }
                $totalBook += $req->books_count;
            }
            if ($totalBook == 5) {
                return redirect()->route('cart')->with('mess', trans('request.fail_mess'));
            }
        }
        $borrowed_date = Carbon::parse($request->borrowed_date);
        $return_date = Carbon::parse($request->return_date);
        $total_date = $return_date->diffinDays($borrowed_date);
        if ($total_date > 30) {
            return redirect()->back()->withInput()->with('mess', trans('request.fail_mess'));
        }
        $req = new Request;

        $order = $req->create([
            'user_id' => Auth::id(),
            'status' => 0,
            'borrowed_date' => $request->borrowed_date,
            'return_date' => $request->return_date,
        ]);
        foreach ($cart as $item) {
            $book = Book::findOrFail($item['id']);
            $book->update([
                'in_stock' => $book->in_stock - 1,
            ]);
            $order->books()->attach($book);
        }
        session()->forget('cart');
        session()->save();

        return redirect()->route('cart')->with('mess', trans('request.success_mess'));
    }
}
