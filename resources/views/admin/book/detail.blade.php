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
                            <img class="profile-user-img img-responsive img-circle"
                                src="{{ asset('upload/book/' . $book->image) }}"
                                title="{{ trans('book.book') }}: {{ $book->name }}">
                            <h3 class="profile-username text-center">{{ $book->name }}</h3>
                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Name</b> <a class="pull-right">{{ $book->name }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>In Stock</b> <a class="pull-right">{{ $book->in_stock }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Total</b> <a class="pull-right">{{ $book->total }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Trạng thái</b> <a
                                        class="pull-right">{{ $book->status == 0 ? 'Đang hiển thị' : 'Đã ẩn' }}</a>
                                </li>
                            </ul>
                            <div class="form-group text-center">
                                <a href="{{ route('book.edit', [$book->id]) }}" class="btn btn-danger"><b>Chỉnh sửa
                                        thông tin</b></a>
                                <a href="{{ route('book.index') }}" class="btn btn-primary"><b>Quay lại</b></a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Chi tiet</h3>
                        </div>
                        <div class="box-body">
                            <p>{!! $book->description !!}</p>
                        </div>
                    </div>
                </div> --}}
                <div class="col-sm-9">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">About Me</h3>
                        </div>
                        <div class="box-body">
                            <strong><i class="fa fa-tags margin-r-5"></i> Category</strong>
                            <p class="text-muted">
                                <span class="label label-danger">
                                    @foreach ($book->categories as $category)
                                        {{ $category->name }}
                                    @endforeach
                                </span>
                            </p>
                            <hr>
                            <strong><i class="fa fa-address-book margin-r-5"></i> Author</strong>
                            <p class="text-muted">{{ $book->author->name }}</p>
                            <hr>
                            <strong><i class="fa fa-building margin-r-5"></i> Publisher</strong>
                            <p>
                                {{ $book->publisher->name }}
                            </p>
                            <hr>
                            <strong><i class="fa fa-file-text-o margin-r-5"></i> Description</strong>
                            <p>
                                {!! ($book->description == '') ? 'Unknow' : $book->description !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
