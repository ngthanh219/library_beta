<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->get();

        return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->all();

        $user = User::where('email', $data['email'])->first();
        if (!$user) {
            $data['password'] = bcrypt($data['password']);
            User::create($data);
            $request->session()->flash('infoMessage', trans('user.create_user_success'));

            return redirect()->route('user.index');
        } else {
            $request->session()->flash('checkIssetEmail', trans('user.isset_email'));

            return redirect()->route('user.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('admin.user.edit', compact('user'));
        } else {
            session()->flash('infoMessage', trans('user.isset_id'));

            return redirect()->route('user.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->update([
                'name' => $request->name,
                'adrress' => $request->address,
                'phone' => $request->phone,
            ]);
            session()->flash('infoMessage', trans('user.update_user_success'));

            return redirect()->route('user.index');
        } else {
            session()->flash('infoMessage', trans('user.isset_id'));

            return redirect()->route('user.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('infoMessage', trans('user.delete_user_success'));

            return redirect()->route('user.index');
        } else {
            session()->flash('infoMessage', trans('user.isset_id'));

            return redirect()->route('user.index');
        }
    }

    public function search(Request $request)
    {
        $users = User::where('name','LIKE','%'.$request->name.'%')->orderBy('id', 'DESC')->get();

        return view('admin.user.search', compact('users'));
    }
}
