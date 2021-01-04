<div class="box-body table-responsive no-padding">
    <table class="table table-hover text-center">
        @if ($books->isEmpty())
            <tr>
                <th>{{ trans('book.empty_information') }}</th>
            </tr>
        @else
            <tbody>
                <tr>
                    <th>{{ trans('book.name') }}</th>
                    <th>{{ trans('book.image') }}</th>
                    <th>{{ trans('book.status') }}</th>
                    <th>{{ trans('book.actions') }}</th>
                </tr>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->name }}</td>
                        <td>
                            @if ($book->image)
                                <img class="image" src="{{ asset('upload/book/' . $book->image) }}"
                                    title="{{ trans('book.book') }}: {{ $book->name }}">
                            @else
                                {{ trans('publisher.unknow') }}
                            @endif
                        </td>
                        <td>
                            @if ($book->status == 0)
                                <p class="success-order">{{ trans('visible') }}</p>
                            @else
                                <p class="waiting-order">{{ trans('hidden') }}</p>
                            @endif
                        </td>
                        <td class="td general">
                            <a href="{{ route('book.show', [$book->id]) }}" title="Xem chi tiết">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('book.edit', $book->id) }}"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa?')" class="delete-form general">
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
        @endif
    </table>
</div>
