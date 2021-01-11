<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $page = $request->page;
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::get()->take(config('pagination.limit_author'));
        $books = Book::with('categories')->orderBy('id', 'desc')->where('status', '0')->paginate(config('pagination.limit'));

        return view('client.home', compact('categories', 'authors', 'books', 'page'));
    }

    public function cateBook($categoryId)
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::get()->take(config('pagination.limit_author'));
        $category = Category::findOrFail($categoryId)->load('books');

        return view('client.category_book', compact('categories', 'authors', 'category'));
    }

    public function detail($id)
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::get()->take(config('pagination.limit_author'));
        $book = Book::findOrFail($id)->load('author', 'categories', 'publisher', 'likes.user');

        return view('client.detail_book', compact('categories', 'authors', 'book'));
    }
}
