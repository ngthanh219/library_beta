@extends('admin/layout')

@section('index')
    <div class="content-wrapper" id="formContent">
        <section class="content-header">
            <h1>{{ trans('user.users_manager') }}</h1>
            <div class="timeline-footer general">
                <a href="{{ route('admin.user.create') }}" class="btn btn-primary btn general">
                    <i class="fa fa-plus-square general"></i> {{ trans('user.add_submit_button') }}
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
                        home
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="{{ asset('bower_components/admin-lte/dist/js/component/search/search.js') }}" defer>
    </script>
    <script type="text/javascript" src="{{ asset('bower_components/admin-lte/dist/js/component/general.js') }}" defer>
    </script>
@endsection
