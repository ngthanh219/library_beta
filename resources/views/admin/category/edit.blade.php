@extends('admin/layout')
@section('index')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ trans('category.category_create') }}</h1>
            <ol class="breadcrumb">
                <li>{{ trans('category.categories_manager') }}</li>
            </ol>
        </section>
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#settings" data-toggle="tab"
                                    aria-expanded="true">{{ trans('category.category_form') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="settings">
                                <form class="form-horizontal" action="{{ route('admin.category.update', $category->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="inputName"
                                            class="col-sm-2 control-label">{{ trans('category.name') }}</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="name"
                                                value="{{ $category->name }}" />
                                            @if ($errors->has('name'))
                                                <div class="error">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Select list</label>
                                        <div class="col-sm-10">
                                            <select class="form-control select2" style="width: 100%" id="sel1"
                                                name="parent_id">
                                                <option value="0">-- Category --</option>
                                                @foreach ($categories as $item)
                                                    @if ($item->id == $category->parent_id))
                                                        <option value="{{ $item->id }}" selected>{{ $item->name }}
                                                        </option>
                                                    @else
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" id="add"
                                                class="btn btn-danger">{{ trans('category.edit_submit_button') }}</button>
                                            <a href="{{ route('admin.category.index') }}"
                                                class="btn btn-info quaylai">{{ trans('category.return') }}</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
