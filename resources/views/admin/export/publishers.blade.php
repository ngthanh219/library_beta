<table class="table table-hover text-center">
    <tbody>
        <tr>
            <th>{{ trans('publisher.publisher_name') }}</th>
            <th>{{ trans('publisher.email') }}</th>
            <th>{{ trans('publisher.phone') }}</th>
            <th>{{ trans('publisher.address') }}</th>
        </tr>
        @foreach ($publishers as $publisher)
            <tr>
                <td>{{ $publisher->name }}</td>
                <td>{{ $publisher->description ? $publisher->description : trans('publisher.unknow') }}
                </td>
                <td>{{ $publisher->phone ? $publisher->phone : trans('publisher.unknow') }}
                </td>
                <td>{{ $publisher->address ? $publisher->address : trans('publisher.unknow') }}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
