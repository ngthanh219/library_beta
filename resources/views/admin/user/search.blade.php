<div class="box-body table-responsive no-padding">
    <table class="table table-hover text-center">
        @if ($users->isEmpty())
            <tr>
                <th>{{ trans('user.empty_information') }}</th>
            </tr>
        @else
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
                        <td>{{ $user->role_id }}</td>
                        <td>{{ $user->status == 0 ? trans('user.on') : trans('user.off') }}</td>
                        <td class="td general">
                            <a href="{{ route('admin.user.edit', $user->id) }}"><i class="fa fa-pencil"></i></a>
                            <form action="{{ route('admin.user.destroy', $user->id) }}" method="POST"
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
