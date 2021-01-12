@extends('client.layout')
@section('content')
    @if ($category->books->isEmpty())
        <h4>{{ trans('book.empty_information') }}</h4>
    @else
        <section class="grid-holder features-books">
            @foreach ($category->books as $book)
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
                    <li><a href="#">Prev</a></li>
                    <li class="active">
                        <a href="#">1</a>
                    </li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">Next</a></li>
                </ul>
            </div>
    @endif
@endsection
