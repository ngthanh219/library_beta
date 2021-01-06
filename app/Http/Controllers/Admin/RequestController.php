<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckRequest;
use App\Models\Request;

class RequestController extends Controller
{
    public function index() {
        $requests = Request::with('user')->get();

        return view('admin.request.index', compact('requests'));
    }
}
