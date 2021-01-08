<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Request;
use App\Models\User;
use Auth;

class RequestController extends Controller
{
    public function cart()
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::paginate(5);
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
        $user = User::findOrFail(Auth::id());
        if (!$user->requests->isEmpty()) {
            foreach ($user->requests as $request) {
                if ($request->status == 0) {
                    return redirect()->route('cart')->with('mess', trans('request.pending_mess'));
                }
                if ($request->status == 4) {
                    return redirect()->route('cart')->with('mess', trans('request.late_mess'));
                }
            }
        }
        $data = $request->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 0;
        $order = Request::create($data);
        $cart = session()->get('cart');
        foreach ($cart as $item) {
            $book = Book::findOrFail($item['id']);
            $order->books()->attach($book);
        }
        session()->forget('cart');
        session()->save();

        return redirect()->route('cart')->with('mess', trans('request.success_mess'));
    }
}
