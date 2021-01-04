@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('admin.authors_manager') }}</h1>
            <div class="timeline-footer general">
                <a href="{{ route('author.create') }}" class="btn btn-primary btn general">
                    <i class="fa fa-plus-square general"></i> {{ trans('admin.add_submit_button') }}
                </a>
            </div>
            <ol class="breadcrumb">
                <li>{{ trans('admin.author') }}</li>
            </ol>
            @if (session()->has('infoMessage'))
                <div class="infoMessage">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bell-o"></i>
                                {{ trans('admin.notifi') }}
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
                            <h3 class="box-title">{{ trans('admin.author_list') }}</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs">
                                    <input type="text" onkeyup="showResult(this.value)" name="search"
                                        class="form-control pull-right" placeholder="{{ trans('admin.author_filter') }}"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="livesearch"></div>
                        <div class="box-body table-responsive no-padding" id="tableContent">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('admin.author_name') }}</th>
                                        <th>{{ trans('admin.avatar') }}</th>
                                        <th>{{ trans('admin.description') }}</th>
                                        <th>{{ trans('admin.date_of_born') }}</th>
                                        <th>{{ trans('admin.date_of_death') }}</th>
                                        <th>{{ trans('admin.actions') }}</th>
                                    </tr>
                                    @foreach ($authors as $author)
                                        <tr>
                                            <td>{{ $author->name }}</td>
                                            <td>
                                                @if ($author->image)
                                                    <img class="image-avatar"
                                                        src="{{ asset('upload/author/' . $author->image) }}"
                                                        title="{{ trans('admin.author') }}: {{ $author->name }}">
                                                @else
                                                    {{ trans('admin.unknow') }}
                                                @endif
                                            </td>
                                            <td>{{ $author->description ? $author->description : trans('admin.unknow') }}
                                            </td>
                                            <td>{{ $author->date_of_born ? $author->date_of_born : trans('admin.unknow') }}
                                            </td>
                                            <td>{{ $author->date_of_death ? $author->date_of_death : trans('admin.unknow') }}
                                            </td>
                                            <td class="td general">
                                                <a href="{{ route('author.edit', $author->id) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form action="{{ route('author.destroy', $author->id) }}" method="POST"
                                                    class="delete delete-form general" id="delete">
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
    <script type="text/javascript" src="{{ asset('bower_components/admin-lte/dist/js/component/search/search_admin.js') }}"
        defer></script>
@endsection
