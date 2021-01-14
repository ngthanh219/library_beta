@extends('client.layout')
@section('content')
    <section class="b-detail-holder">
        <article class="title-holder">
            <div class="span6">
                <h4><strong>{{ $book->name }}</strong> by {{ $book->author->name }}</h4>
            </div>
            @if (Auth::check())
                <div class="span6 book-d-nav">
                    <ul>
                        <li>
                            <a class="l-react" href="{{ $book->id }}">
                                @php
                                $class = 'reaction-like'
                                @endphp
                                @if ($book->likes->isEmpty())
                                    @php
                                    $class
                                    @endphp
                                @else
                                    @foreach ($book->likes as $like)
                                        @if ($like->status == 1 && $like['user']->id == Auth::user()->id)
                                            @php
                                            $class .= ' liked'
                                            @endphp
                                        @endif
                                    @endforeach
                                @endif
                                <span id="reaction-like" class="{{ $class }}">
                                    <i class="icon-heart"></i>
                                    @php
                                    $index = 0;
                                    @endphp
                                    @if ($book->likes->isEmpty())
                                        {{ $index }}
                                    @else
                                        @foreach ($book->likes as $like)
                                            @if ($like->status == 1)
                                                @php
                                                $index++
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{ $index }}
                                    @endif
                                    likes
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            @else
                <div class="span6 book-d-nav">
                    <ul>
                        <li>
                            <a class="l-react">
                                <span>
                                    <i class="icon-heart"></i>
                                    @php
                                    $index = 0;
                                    @endphp
                                    @if ($book->likes->isEmpty())
                                        {{ $index }}
                                    @else
                                        @foreach ($book->likes as $like)
                                            @if ($like->status == 1)
                                                @php
                                                $index++
                                                @endphp
                                            @endif
                                        @endforeach
                                        {{ $index }}
                                    @endif
                                    likes
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            @endif
        </article>
        <div class="book-i-caption">
            <div class="span6 b-img-holder">
                <span class='zoom' id='ex1'>
                    <div id="book_id" class="hidden">{{ $book->id }}</div>
                    <img src="{{ asset('upload/book/' . $book->image) }}" height="219" width="300" id='jack'
                        alt="{{ $book->name }}" />
                </span>
            </div>
            <div class="span6">
                <strong class="title">{{ $book->name }}</strong>
                <p>{!! $book->description !!}</p>
                <p>In stock: <a>{{ $book->in_stock }}</a></p>
                <div class="comm-nav">
                    <ul>
                        <li>
                            <a href="{{ $book->id }}" class="more-btn add-to-cart">+ Add to Cart</a>
                        </li>
                    </ul>
                </div>
                <div class="comm-nav">
                    <ul>
                        <li>
                            <label>How do you rate this book? *</label>
                            <div class="rating-list">
                                <div class="rating-box">
                                    @foreach ($votes as $vote)
                                        @if ($book->rates->isEmpty())
                                            <input type="radio" name="vote" class="vote" id="start{{ $vote }}"
                                            value="{{ $vote }}">
                                            <label for="start{{ $vote }}"></label>
                                        @else
                                            @foreach ($book->rates as $item)
                                                @if ($item->vote == $vote)
                                                    <input type="radio" name="vote" class="vote" id="start{{ $vote }}"
                                                        value="{{ $vote }}" checked>
                                                    <label for="start{{ $vote }}"></label>
                                                @else
                                                    <input type="radio" name="vote" class="vote" id="start{{ $vote }}"
                                                    value="{{ $vote }}">
                                                    <label for="start{{ $vote }}"></label>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="comm-nav star-book" id="star-book">
                    {{-- @foreach ($votes as $vote)
                        <a href="{{ $vote }}" class="high-l-star {{ $vote }}" id="hi-start" date-key="{{ $vote }}">
                            <i class="icon-star-empty" id="star-empty-{{ $vote }}"></i>
                            <i class="vote-current voted-{{ $vote }}" id="vote-current-{{ $vote }}"></i>
                        </a>
                    @endforeach --}}
                </div>
            </div>
        </div>
        <div class="tabbable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#pane1" data-toggle="tab">{{ trans('category.category') }}</a></li>
                <li><a href="#pane2" data-toggle="tab">{{ trans('author.author') }}</a></li>
                <li><a href="#pane3" data-toggle="tab">{{ trans('publisher.publisher') }}</a></li>
            </ul>
            <div class="tab-content">
                <div id="pane1" class="tab-pane active">
                    @foreach ($book->categories as $category)
                        <p><b>{{ $category->name }}</b></p>
                    @endforeach
                </div>
                <div id="pane2" class="tab-pane">
                    <h4> <b>{{ trans('author.name') }}</b>: {{ $book->author->name }}</h4>
                    <h4> <b>{{ trans('author.date_born') }}</b>: {{ $book->author->date_of_born }}</h4>
                    <h4> <b>{{ trans('author.date_death') }}:</b> {{ $book->author->date_of_death }}</h4>
                    <h4> <b>{{ trans('author.description') }}:</b>
                        {{ $book->author->description == '' ? trans('author.unknow') : $book->author->description }}
                    </h4>
                </div>
                <div id="pane3" class="tab-pane">
                    <h4> <b>{{ trans('publisher.name') }}</b>: {{ $book->publisher->name }}</h4>
                    <h4> <b>{{ trans('publisher.email') }}</b>: {{ $book->publisher->email }}</h4>
                    <h4> <b>{{ trans('publisher.phone') }}</b>: {{ $book->publisher->phone }}</h4>
                    <h4> <b>{{ trans('publisher.address') }}</b>: {{ $book->publisher->address }}</h4>
                </div>
            </div>
        </div>
        <section class="related-book">
            <div class="heading-bar">
                <h2>Related Books</h2>
                <span class="h-line"></span>
            </div>
            <div class="slider6">
                @foreach ($book->categories as $category)
                    @foreach ($category->books as $related)
                        `<div class="slide">
                            <a href="book-detail.html"><img
                                    src="{{ $related->image ? asset('upload/book' . $related->image) : '' }}" alt=""
                                    class="pro-img" /></a>
                            <span class="title"><a href="book-detail.html">{{ $related->name }}</a></span>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </section>
        <section class="reviews-section">
            <figure class="left-sec">
                <div class="r-title-bar">
                    <strong>Customer Reviews</strong>
                </div>
                <ul class="review-list" id="cmt-data">
                    @foreach ($book->comments as $cmt)
                        <li>
                            <em class="bold-text">{{ $cmt->user->name }}</em>
                            <p>{{ $cmt->comment }}</p>
                        </li>
                    @endforeach
                </ul>
            </figure>
            <script>
                $('#cmt-data').scroll(function () {
                    var scrollCurrent = $('#cmt-data').scrollTop();
                    var heightCurrent = $('#cmt-data').height();
                    var tb = heightCurrent - scrollCurrent;
                    if(heightCurrent - scrollCurrent == 145) {

                    }
                });
            </script>
            <figure class="right-sec">
                <ul class="review-f-list">
                    <li>
                        <label>Your review *</label>
                        <form action="" class="cmt-form">
                            <textarea name="comment" id="comment" cols="2" rows="10"></textarea>
                            <button type="submit" id="btn-cmt" class="btn-bt event-none">Comment</button>
                        </form>
                    </li>
                </ul>
            </figure>
        </section>
    </section>
    <script src="{{ asset('js/add_cart.js') }}" defer></script>
    <script src="{{ asset('js/like_book.js') }}" defer></script>
    <script src="{{ asset('js/comment_book.js') }}" defer></script>
    <script src="{{ asset('js/vote_book.js') }}" defer></script>
@endsection
