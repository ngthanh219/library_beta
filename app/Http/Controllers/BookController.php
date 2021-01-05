<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Book;
use App\Http\Requests\CreateBookRequest;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();

        return view('admin.book.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '<>' ,'0')->get();
        $categoryParents = Category::where('parent_id', 0)->get();
        $authors = Author::all();
        $publishers = Publisher::all();

        return view('admin.book.create', compact('categories', 'categoryParents', 'authors', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateBookRequest $request)
    {
        $data = $request->all();
        $data['in_stock'] = $data['total'];
        if (!isset($data['image'])) {
            $data['image'] = '';
        } else {
            $image = time() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move('upload/book', $image);
            $data['image'] = $image;
        }
        $book = Book::create($data);
        foreach ($data['category_id'] as $category) {
            $item = Category::findOrFail($category);
            $book->categories()->attach($item);
        }
        $request->session()->flash('infoMessage', trans('book.create_book_success'));

        return redirect()->route('book.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id)->load('author', 'publisher', 'categories');
        if ($book) {
            return view('admin.book.detail', compact('book'));
        } else {
            session()->flash('infoMessage', trans('book.isset_id'));

            return redirect()->route('book.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::with('books')->get();
        $authors = Author::with('books')->get();
        $publishers = Publisher::with('books')->get();
        $book = Book::with('author', 'publisher', 'categories')->findOrFail($id);

        return view('admin.book.edit', compact('categories', 'authors', 'publishers', 'book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateBookRequest $request, $id)
    {
        $book = Book::findOrFail($id);
        $data = $request->all();
        if (isset($data['image'])) {
            $image = time() . '_' . $data['image']->getClientOriginalName();
            $data['image']->move('upload/book', $image);
            $data['image'] = $image;
        } else {
            $data['image'] = $book->image;
        }
        $book->categories()->sync($data['category_id']);
        $book->update($data);
        $request->session()->flash('infoMessage', trans('book.create_book_success'));

        return redirect()->route('book.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->categories()->sync([]);
        $book->delete();
        session()->flash('infoMessage', trans('book.delete_book_success'));

        return redirect()->route('book.index');
    }

    public function search(Request $request)
    {
        $books = Book::where('name', 'LIKE', '%' . $request->key . '%',)->orderBy('id', 'DESC')->get();

        return view('admin.book.search', compact('books'));
    }
}
