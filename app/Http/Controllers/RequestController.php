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
        if (empty($cart)) {
            $cart = [
                $id => [
                    'id' => $id,
                    'image' => $book->image,
                    'name' => $book->name,
                ],
            ];
        } else {
            if (isset($cart[$id])) {
                return back()->with('message', 'Chi duoc 1 lan');
            } else {
                $cart[$id] = [
                    'id' => $id,
                    'image' => $book->image,
                    'name' => $book->name,
                ];
            }
        }
        session()->put('cart', $cart);
        session()->save();

        return back()->with('message', 'OK');
        // if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        //     echo json_encode([
        //         'message' => 'Đã cập nhật sản phẩm vào giỏ hàng',
        //     ]);
        // } else {
        //     return back();
        // }
    }

    public function request(OrderRequest $request)
    {

        $user = User::findOrFail(Auth::id());
        // dd($user->requests);
        foreach ($user->requests as $request) {
            if ($request->status == 0) {
                return back()->with('mess', trans('request.pending_mess'));
            }
            if ($request->status == 4) {
                return back()->with('mess', trans('request.late_mess'));
            }
        }
        die;
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

        return redirect()->route('home');
    }
}
