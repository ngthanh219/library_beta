<div class="box-body table-responsive no-padding">
    <table class="table table-hover text-center">
        <tbody>
            <tr>
                <th>{{ trans('admin.author_name') }}</th>
                <th>{{ trans('admin.image') }}</th>
                <th>{{ trans('admin.description') }}</th>
                <th>{{ trans('admin.date_of_born') }}</th>
                <th>{{ trans('admin.date_of_death') }}</th>
            </tr>
            @foreach ($authors as $author)
                <tr>
                    <td>{{ $author->name }}</td>
                    <td>
                        @if ($author->image)
                            <img class="image" src="{{ asset('upload/author/' . $author->image) }}"
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
                    <td style="display: flex;justify-content: center;">
                        <a href="{{ route('author.edit', $author->id) }}"><i
                                class="fa fa-pencil"></i></a>
                        <form action="{{ route('author.destroy', $author->id) }}" method="POST"
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