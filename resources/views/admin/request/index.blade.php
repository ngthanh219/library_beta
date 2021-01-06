@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('request.categories_manager') }}</h1>
            <ol class="breadcrumb">
                <li>{{ trans('request.request') }}</li>
            </ol>
            @if (session()->has('infoMessage'))
                <div class="infoMessage">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bell-o"></i>
                                {{ trans('request.notifi') }}
                            </h3>
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                        class="fa fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="box-body">
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
                            <h3 class="box-title">{{ trans('request.request_list') }}</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs">
                                    <input type="text" onkeyup="showResult(this.value)" name="search"
                                        class="form-control pull-right" placeholder="{{ trans('request.request_search') }}"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="livesearch"></div>
                        <div class="box-body table-responsive no-padding" id="tableContent">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('request.user_name') }}</th>
                                        <th>{{ trans('request.borrowed_date') }}</th>
                                        <th>{{ trans('request.return_date') }}</th>
                                        <th>{{ trans('request.status') }}</th>
                                        <th>{{ trans('request.actions') }}</th>
                                    </tr>
                                    @foreach ($requests as $request)
                                        <tr>
                                            <td>
                                                <b>{{ $request->user->name }}</b>
                                            </td>
                                            <td>
                                                <b>{{ $request->borrowed_date }}</b>
                                            </td>
                                            <td>
                                                <b>{{ $request->return_date }}</b>
                                            </td>
                                            <td>
                                                @if ($request->status == 0)
                                                    <p class="waiting-order">{{ trans('request.pending') }}</p>
                                                @elseif ($request->status == 1)
                                                    <p class="success-order">{{ trans('request.accept') }}</p>
                                                @elseif ($request->status == 2)
                                                    <p class="waiting-order">{{ trans('request.reject') }}</p>
                                                @endif
                                            </td>
                                            <td class="td general">
                                                <a href=""
                                                    title="{{ trans('request.accept') }}">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                <a href=""
                                                    title="{{ trans('request.reject') }}"><i class="fa fa-pencil"></i></a>
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
        src="{{ asset('bower_components/request-lte/dist/js/component/search/search_request.js') }}" defer></script>
@endsection
