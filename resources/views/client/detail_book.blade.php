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
                                    <i class="icon-thumbs-up"></i>
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
                @foreach ($relatedBooks as $releted)
                    <div class="slide">
                        <a href="book-detail.html"><img src="{{ $book->image ? asset('upload/book' . $book->image) : '' }}"
                                alt="" class="pro-img" /></a>
                        <span class="title"><a href="book-detail.html">{{ $releted->name }}</a></span>
                    </div>
                @endforeach
            </div>
        </section>
        <section class="reviews-section">
            <figure class="left-sec">
                <div class="r-title-bar">
                    <strong>Customer Reviews</strong>
                </div>
                <ul class="review-list">
                    <li>

                        <em class="">The Kite Runner</em>
                        <p>“ Suspendisse tortor lacus, suscipit eget pharetra sed, ornare sed elit. Curabitur mollis, justo
                            sit amet fermentum ” Review by Bookshoppe’</p>
                    </li>
                </ul>
            </figure>
            <figure class="right-sec">
                <ul class="review-f-list">
                    <li>
                        <label>Your review *</label>
                        <textarea name="" cols="2" rows="20"></textarea>
                    </li>
                    <li>
                        <label>How do you rate this book? *</label>
                        <div class="rating-list">
                            <div class="rating-box">
                                <label class="radio">
                                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                    Star 1
                                </label>
                            </div>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Star 2
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>
                                Star 3
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Star 4
                            </label>
                            <label class="radio">
                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                Star 5
                            </label>
                        </div>
                    </li>
                </ul>
                <a href="#" class="grey-btn left-btn">Write Your Own Review</a>
            </figure>fer
        </section>
    </section>
    <script src="{{ asset('js/add_cart.js') }}" defer></script>
    <script src="{{ asset('js/like_book.js') }}" defer></script>
@endsection
