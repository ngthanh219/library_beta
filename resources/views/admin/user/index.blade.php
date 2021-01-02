@extends('admin.layout')
@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('user.users_manager') }}</h1>
            <div class="timeline-footer" style="padding: 10px 0px">
                <a href="{{ route('user.create') }}" class="btn btn-primary btn" style="margin-right: 5px;">
                    <i class="fa fa-plus-square" style="margin-right: 5px;"></i> {{ trans('user.add_submit_button') }}
                </a>
            </div>
            <ol class="breadcrumb">
                <li>{{ trans('user.menu') }}</li>
            </ol>
            @if (session()->has('infoMessage'))
                <div class="col-md-3 infoMessage">
                    <div class="box box-warning box-solid">
                        <div class="box-header with-border">
                            <h3 class="box-title">
                                <i class="fa fa-bell-o"></i>
                                {{ trans('user.notifi') }}
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
                <script>
                    $('.infoMessage').delay(1500).slideUp();

                </script>
            @endif
        </section>
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">{{ trans('user.list') }}</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm hidden-xs">
                                    <input type="text" onkeyup="showResult(this.value)" name="search"
                                        class="form-control pull-right" placeholder="{{ trans('user.filter') }}"
                                        autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div id="livesearch"></div>
                        <div class="box-body table-responsive no-padding" id="tableContent">
                            <table class="table table-hover text-center">
                                <tbody>
                                    <tr>
                                        <th>{{ trans('user.name') }}</th>
                                        <th>{{ trans('user.email') }}</th>
                                        <th>{{ trans('user.phone') }}</th>
                                        <th>{{ trans('user.role_id') }}</th>
                                        <th>{{ trans('user.status') }}</th>
                                        <th>{{ trans('user.actions') }}</th>
                                    </tr>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->role_id == 0 ? 'Admin' : 'User' }}</td>
                                            <td>{{ $user->status == 0 ? trans('user.on') : trans('user.off') }}</td>
                                            <td style="display: flex;justify-content: center;">
                                                <a href="{{ route('user.edit', $user->id) }}"><i
                                                        class="fa fa-pencil"></i></a>
                                                <form action="{{ route('user.destroy', $user->id) }}" method="POST"
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
    <script type="text/javascript" src="{{ asset('bower_components/admin-lte/dist/js/component/search/search_user.js') }}"
        defer></script>
@endsection
