<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Request::with('user')->orderBy('id', 'DESC')->get();

        return view('admin.request.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Request::findOrFail($id)->load('books.author', 'books.categories', 'user');

        return view('admin.request.show', compact('request'));
    }

    public function accept($id)
    {
        $request = Request::with('books')->findOrFail($id);

        if ($request->status == 0 || $request->status == 2) {
            $result = $request->update([
                'status' => 1,
            ]);
            if ($result) {
                return redirect()->back()->with('infoMessage',
                    trans('message.request_accept_success'));
            }

            return redirect()->back()->with('infoMessage',
                trans('message.request_accept_fail'));
        }

        abort(404);
    }

    public function reject($id)
    {
        $request = Request::findOrFail($id);
        if ($request->status == 0 || $request->status == 1) {
            foreach ($request->books as $book) {
                $book->update([
                    'in_stock' => $book->in_stock + 1,
                ]);
            }
            $result = $request->update([
                'status' => 2,
            ]);
            if ($result) {
                return redirect()->back()->with('infoMessage',
                    trans('message.request_reject_success'));
            }

            return redirect()->back()->with('infoMessage',
                trans('message.request_reject_fail'));
        }

        abort(404);
    }

    public function undo($id)
    {
        $request = Request::findOrFail($id);
        if ($request->status == 1 || $request->status == 2 || $request->status == 3 || $request->status == 4) {
            if ($request->status == 1) {
                $result = $request->update([
                    'status' => 0,
                ]);
            } elseif ($request->status == 2) {
                foreach ($request->books as $book) {
                    $book->update([
                        'in_stock' => $book->in_stock - 1,
                    ]);
                }
                $result = $request->update([
                    'status' => 0,
                ]);
            } elseif ($request->status == 3) {
                $result = $request->update([
                    'status' => 1,
                ]);
            } elseif ($request->status == 4) {
                foreach ($request->books as $book) {
                    $book->update([
                        'in_stock' => $book->in_stock - 1,
                    ]);
                }
                $result = $request->update([
                    'status' => 3,
                ]);
            }
            if ($result) {
                return redirect()->back()->with('infoMessage',
                    trans('message.request_undo_success'));
            }

            return redirect()->back()->with('infoMessage',
                trans('message.request_undo_fail'));
        }

        abort(404);
    }

    public function borrowedBook($id)
    {
        $request = Request::findOrFail($id);
        if ($request->status == 1) {
            $result = $request->update([
                'status' => 3,
            ]);
            if ($result) {
                return redirect()->back()->with('infoMessage',
                    trans('message.request_reject_success'));
            }

            return redirect()->back()->with('infoMessage',
                trans('message.request_reject_fail'));
        }

        abort(404);
    }

    public function returnBook($id)
    {
        $request = Request::findOrFail($id);
        if ($request->status == 3) {
            foreach ($request->books as $book) {
                $book->update([
                    'in_stock' => $book->in_stock + 1,
                ]);
            }
            $result = $request->update([
                'status' => 4,
            ]);
            if ($result) {
                return redirect()->back()->with('infoMessage',
                    trans('message.request_return_success'));
            }

            return redirect()->back()->with('infoMessage',
                trans('message.request_return_fail'));
        }

        abort(404);
    }
}
