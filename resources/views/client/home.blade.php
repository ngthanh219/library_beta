@extends('client.layout')
@section('content')
    <div class="product_sort">
        <div class="row-1">
            <div class="left">
                <span class="s-title">Sort by</span>
                <span class="list-nav">
                    <select name="">
                        <option>Position</option>
                        <option>Position 2</option>
                        <option>Position 3</option>
                        <option>Position 4</option>
                    </select>
                </span>
            </div>
            <div class="right">
                <span>Show</span>
                <span>
                    <select name="">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                    </select>
                </span>
                <span>per page</span>
            </div>
        </div>
        <div class="row-2">
            <span class="left">Items 1 to 9 of 15 total</span>
            <ul class="product_view">
                <li>View as:</li>
                <li>
                    <a class="grid-view" href="grid-view.html">Grid View</a>
                </li>
                <li>
                    <a class="list-view" href="list-view.html">List View</a>
                </li>
            </ul>
        </div>
    </div>
    <section class="grid-holder features-books">
        @foreach ($books as $book)
            <figure class="span4 slide wapper">
                <a href="{{ route('detail', $book->id) }}"><img src="{{ asset('upload/book/' . $book->image) }}" alt=""
                        class="pro-img" /></a>
                <span class="title wapper"><a href="{{ route('detail', $book->id) }}">{{ $book->name }}</a></span>
            </figure>
        @endforeach
    </section>
    <div class="blog-footer wapper">
        <div class="pagination">
            <ul>
                @if ($books->lastPage() > 1)
                    @for ($i = 1; $i <= $books->lastPage(); $i++)
                        @if (isset($page) && $page == $i)
                            <li class="active">
                                <a href="{{ $books->url($i) }}">{{ $i }}</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ $books->url($i) }}">{{ $i }}</a>
                            </li>
                        @endif
                    @endfor
                @endif
            </ul>
        </div>
    </div>
@endsection
