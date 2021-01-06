<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Author;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::paginate(5);
        $books = Book::with('categories')->orderBy('id', 'desc')->where('status', '0')->get();

        return view('client.home', compact('categories', 'authors', 'books'));
    }

    public function cateBook($categoryId)
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::paginate(5);
        $category = Category::findOrFail($categoryId)->load('books');

        return view('client.category_book', compact('categories', 'authors', 'category'));
    }

    public function detail($id)
    {
        $categories = Category::with('children')->where('parent_id', '0')->get();
        $authors = Author::paginate(5);
        $book = Book::findOrFail($id)->load('author', 'categories', 'publisher');

        return view('client.detail_book', compact('categories', 'authors', 'book'));
    }
}
