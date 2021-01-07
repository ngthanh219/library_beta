@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('book.books_manager') }}</h1>
            <ol class="breadcrumb">
                <li>{{ trans('book.menu') }}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <h3 class="profile-username text-center">{{ $request->user->name }}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>{{ trans('user.email') }}</b> <a class="pull-right">{{ $request->user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('user.phone') }}</b> <a
                                        class="pull-right">{{ $request->user->phone ? $request->user->phone : 'Unknow' }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('user.address') }}</b> <a
                                        class="pull-right">{{ $request->user->address }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>{{ trans('user.status') }}</b> <a class="pull-right">{{ $request->user->status }}</a>
                                </li>
                            </ul>
                            <div class="form-group text-center">
                                @if ($request->status == 0)
                                    <a href="{{ route('admin.accept', $request->id) }}"
                                        class="btn btn-success"><b>{{ trans('request.accept') }}</b></a>
                                    <a href="{{ route('admin.reject', $request->id) }}"
                                        class="btn btn-danger"><b>{{ trans('request.reject') }}</b></a>
                                @elseif($request->status == 1)
                                    <a href="{{ route('admin.reject', $request->id) }}"
                                        class="btn btn-danger"><b>{{ trans('request.reject') }}</b></a>
                                @elseif($request->status == 2)
                                    <a href="{{ route('admin.accept', $request->id) }}"
                                        class="btn btn-success"><b>{{ trans('request.accept') }}</b></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="box">
                                <div class="box-body">
                                    <div id="view">
                                        <form action="" accept-charset="utf-8">
                                            <h1 class="text-center" style="color: red;">THÔNG TIN ĐƠN HÀNG</h1>
                                            <h4>Ngày đặt hàng: <b>{{ $request->borrowed_date }}</b>
                                            </h4>
                                            <h4>Ngày đặt trả: <b>{{ $request->return_date }}</b>
                                            </h4>
                                            <h4>
                                                @php
                                                $start_time = \Carbon\Carbon::parse($request->borrowed_date);
                                                $finish_time = \Carbon\Carbon::parse($request->return_date);
                                                $total_date = $finish_time->diffinDays($start_time);
                                                @endphp
                                                {{ trans('book.total_borrowed_date') }} : <b> {{ $total_date }}
                                                    {{ trans('request.days') }}</b>
                                            </h4>
                                            <h4>
                                                Tình trạng: <b>
                                                    @if ($request->satus == 0) 
                                                        <span
                                                            class="label label-warning">{{ trans('request.pending') }}</span>
                                                    @elseif($request->satus == 1)
                                                        <span
                                                            class="label label-warning">{{ trans('request.accept') }}</span>
                                                    @elseif($request->satus == 2)
                                                        <span
                                                            class="label label-warning">{{ trans('request.reject') }}</span>
                                                    @endif
                                                </b>
                                            </h4>
                                            <br />
                                            <div class="box-body table-responsive no-padding">
                                                <table class="table table-hover text-center">
                                                    <thead>
                                                        <tr>
                                                            <th>{{ trans('book.image') }}</th>
                                                            <th>{{ trans('book.name') }}</th>
                                                            <th>{{ trans('book.author') }}</th>
                                                            <th>{{ trans('book.categorires') }}</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                        $subTotal = 0;
                                                        @endphp
                                                        @foreach ($request->books as $book)
                                                            <tr>
                                                                <td>
                                                                    @if ($book->image != '')
                                                                        <img class="profile-user-img img-responsive img-circle"
                                                                            src="{{ asset('upload/book/' . $book->image) }}"
                                                                            title="{{ trans('book.book') }}: {{ $book->name }}">
                                                                    @else
                                                                        {{ trans('book.image') . ': ' . trans('book.unknow') }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $book->name }}</td>
                                                                <td>{{ $book->author->name }}</td>
                                                                <td>
                                                                    @foreach ($book->categories as $category)
                                                                        <div class="td-with">
                                                                            <span
                                                                                class="label label-info">{{ $category->name }}</span>
                                                                        </div>
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
    </div>
@endsection
