<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Request;

class RequestController extends Controller
{
    public function index()
    {
        $requests = Request::with('user')->get();

        return view('admin.request.index', compact('requests'));
    }

    public function show($id)
    {
        $request = Request::findOrFail($id)->load('books.author', 'books.categories', 'user');

        return view('admin.request.show', compact('request'));
    }

    public function accept($id)
    {
        $request = Request::findOrFail($id);

        if ($request->status == 0 || $request->status == 2) {
            $result = $request->update([
                'status' => 1,
            ]);
            if ($result) {
                return redirect()->route('admin.request')->with('infoMessage',
                    trans('message.request_accept_success'));
            }

            return redirect()->route('admin.category.index')->with('infoMessage',
                trans('message.request_accept_fail'));
        }

        abort(404);
    }

    public function reject($id)
    {
        $request = Request::findOrFail($id);
        if ($request->status == 0 || $request->status == 1) {
            $result = $request->update([
                'status' => 2,
            ]);
            if ($result) {
                return redirect()->route('admin.request')->with('infoMessage',
                    trans('message.request_reject_success'));
            }

            return redirect()->route('admin.category.index')->with('infoMessage',
                trans('message.request_reject_fail'));
        }

        abort(404);
    }
}
