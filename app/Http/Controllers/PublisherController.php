<?php

namespace App\Http\Controllers;

use App\Exports\PublishersExport;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class PublisherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publishers = Publisher::all();

        return view('admin.publisher.index', compact('publishers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.publisher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publisher = new Publisher;
        $image = '';
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->move('upload/publisher', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $publisher->create([
            'image' => $image,
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);
        if ($result) {
            return redirect()->route('publisher.index')->with('infoMessage',
                trans('message.publisher_create_success'));
        }

        return redirect()->route('publisher.index')->with('infoMessage',
            trans('message.publisher_create_fail'));
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
        $publisher = Publisher::findOrFail($id);

        return view('admin.publisher.edit', compact('publisher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $image = $publisher->image;
        if ($request->hasFile('image')) {
            $file = $request->image;
            $file->move('upload/publisher', $file->getClientOriginalName());
            $image = $file->getClientOriginalName();
        }
        $result = $publisher->update([
            'name' => $request->name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'description' => $request->description,
        ]);
        if ($result) {
            return redirect()->route('publisher.index')->with('infoMessage',
                trans('message.publisher_update_success'));
        }

        return redirect()->route('publisher.index')->with('infoMessage',
            trans('message.publisher_update_fail'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $result = $publisher->delete();
        if ($result) {
            return redirect()->route('publisher.index')->with('infoMessage',
                trans('message.publisher_delete_success'));
        }

        return redirect()->route('publisher.index')->with('infoMessage',
            trans('message.publisher_delete_fail'));
    }

    public function export()
    {
        return Excel::download(new PublishersExport, 'publishers.xlsx');
    }
}
