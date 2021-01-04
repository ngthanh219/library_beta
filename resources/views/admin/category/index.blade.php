@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('category.categories_manager') }}</h1>
            <div class="timeline-footer" style="padding: 10px 0px">
                <a href="{{ route('category.create') }}" class="btn btn-primary btn" style="margin-right: 5px;">
                    <i class="fa fa-plus-square" style="margin-right: 5px;"></i>
                    {{ trans('category.add_submit_button') }}
                </a>
            </div>
            <ol class="breadcrumb">
                <li>{{ trans('category.category') }}</li>
            </ol>
            @if (session()->has('infoMessage'))
                <div class="infoMessage">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bell-o"></i>
                                {{ trans('category.notifi') }}
                            </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body" style="">
                            {{ session()->get('infoMessage') }}
                        </div>
                    </div>
                </div>
            @endif
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('category.category_list') }}</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs" style="width: 300px;">
                                    <input type="text" onkeyup="showResult(this.value)" name="search"
                                        class="form-control pull-right"
                                        placeholder="{{ trans('category.category_search') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="livesearch"></div>
                        <div class="box-body table-responsive no-padding" id="tableContent">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('category.category_name') }}</th>
                                        <th>{{ trans('category.actions') }}</th>
                                    </tr>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>
                                                <b>{{ $category->name }}</b>
                                            </td>
                                            <td style="display: flex;justify-content: center;">
                                                <a href="{{ route('category.show', $category->id) }}"><i
                                                        class="fa fa-eye"></i></a>
                                                <a href="{{ route('category.edit', $category->id) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" style="background: none;border: none;">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="col-sm-12 text-right">
                                <div class="dataTables_paginate paging_simple_numbers"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript"
        src="{{ asset('bower_components/category-lte/dist/js/component/search/search_category.js') }}" defer></script>
@endsection
