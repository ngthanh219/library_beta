@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('publisher.publishers_manager') }}</h1>
            <div class="timeline-footer general">
                <a href="{{ route('admin.publisher.create') }}" class="btn btn-primary btn" general>
                    <i class="fa fa-plus-square general"></i>
                    {{ trans('publisher.add_submit_button') }}
                </a>
                <a href="{{ route('admin.publisher.export') }}" class="btn btn-primary btn general">
                    <i class="fa fa-file-excel-o general"></i>
                    {{ trans('publisher.export_submit_button') }}
                </a>
            </div>
            <ol class="breadcrumb">
                <li>{{ trans('publisher.publisher') }}</li>
            </ol>
            @if (session()->has('infoMessage'))
                <div class="infoMessage">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bell-o"></i>
                                {{ trans('publisher.notifi') }}
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
                            <h3 class="box-title">{{ trans('publisher.publisher_list') }}</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs">
                                    <input type="text" name="search-publisher" id="search" class="form-control pull-right"
                                        placeholder="{{ trans('publisher.publisher_filter') }}" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="livesearch"></div>
                        <div class="box-body table-responsive no-padding" id="tableContent">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('publisher.publisher_name') }}</th>
                                        <th>{{ trans('publisher.logo') }}</th>
                                        <th>{{ trans('publisher.email') }}</th>
                                        <th>{{ trans('publisher.phone') }}</th>
                                        <th>{{ trans('publisher.address') }}</th>
                                        <th>{{ trans('publisher.actions') }}</th>
                                    </tr>
                                    @foreach ($publishers as $publisher)
                                        <tr>
                                            <td>{{ $publisher->name }}</td>
                                            <td>
                                                @if ($publisher->image)
                                                    <img class="image"
                                                        src="{{ asset('upload/publisher/' . $publisher->image) }}"
                                                        title="{{ trans('publisher.publisher') }}: {{ $publisher->name }}">
                                                @else
                                                    {{ trans('publisher.unknow') }}
                                                @endif
                                            </td>
                                            <td>{{ $publisher->description ? $publisher->description : trans('publisher.unknow') }}
                                            </td>
                                            <td>{{ $publisher->phone ? $publisher->phone : trans('publisher.unknow') }}
                                            </td>
                                            <td>{{ $publisher->address ? $publisher->address : trans('publisher.unknow') }}
                                            </td>
                                            <td class="td general">
                                                <a href="{{ route('admin.publisher.edit', $publisher->id) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form action="{{ route('admin.publisher.destroy', $publisher->id) }}"
                                                    method="POST" class="delete-form general" id="delete">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit">
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
        src="{{ asset('bower_components/publisher-lte/dist/js/component/search/search_publisher.js') }}" defer></script>
@endsection
