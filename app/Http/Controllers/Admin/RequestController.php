<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckRequest;
use App\Models\Request;
use Carbon\Carbon;

class RequestController extends Controller
{
    public function index() {
        $requests = Request::with('user')->get();

        return view('admin.request.index', compact('requests'));
    }

    public function show($id) {
        $request = Request::findOrFail($id)->load('books', 'user');
        
        dd($request);
    }
}
