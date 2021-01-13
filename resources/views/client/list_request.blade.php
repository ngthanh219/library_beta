@extends('client.layout')
@section('content')
    @if (session()->has('mess'))
        <div class="notification-client">
            <div class="content-message">
                {{ session()->get('mess') }}
            </div>
        </div>
    @endif
    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <section class="span12 cart-holder">
                <div class="heading-bar">
                    <h2>List Request</h2>
                    <span class="h-line"></span>
                </div>
                <div class="cart-table-holder">
                    <table class="cart-table-general" border="0" cellpadding="10">
                        <tr>
                            <th class="col-first-table">#</th>
                            <th class="col" align="left">Borrow Date</th>
                            <th class="col" align="left">Return Date</th>
                            <th class="col" align="left">Total Date</th>
                            <th class="col" align="left">Status</th>
                            <th class="col" align="left">Actions</th>
                        </tr>
                        @php
                        $index = 0;
                        @endphp
                        @foreach ($user->requests as $request)
                            <tr bgcolor="#FFFFFF" class=" product-detail">
                                <td valign="top hige-name">{{ $index++ }}</td>
                                @php
                                $start_time = \Carbon\Carbon::parse($request->borrowed_date);
                                $finish_time = \Carbon\Carbon::parse($request->return_date);
                                $total_date = $finish_time->diffinDays($start_time);
                                @endphp
                                <td valign="top hige-name">{{ $request->borrowed_date }}</td>
                                <td valign="top hige-name">{{ $request->return_date }}</td>
                                @if ($request->status == 5)
                                    <td>
                                        <b>{{ trans('request.too_late') }} {{ $total_date }}
                                            {{ trans('request.days') }}</b>
                                    </td>
                                @elseif($total_date == 0)
                                    <td>
                                        <b>{{ trans('request.last_date') }}</b>
                                    </td>
                                @else
                                    <td>
                                        <b>{{ $total_date }} {{ trans('request.days') }}</b>
                                    </td>
                                @endif
                                <td>
                                    @if ($request->status == 0)
                                        <span class="label label-warning">{{ trans('request.pending') }}</span>
                                    @elseif ($request->status == 1)
                                        <span class="label label-primary">{{ trans('request.accept') }}</span>
                                    @elseif ($request->status == 2)
                                        <span class="label label-danger">{{ trans('request.reject') }}</span>
                                    @elseif ($request->status == 3)
                                        <span class="label label-info">{{ trans('request.borrowing') }}</span>
                                    @elseif ($request->status == 4)
                                        <span class="label label-success">{{ trans('request.return') }}</span>
                                    @elseif ($request->status == 5)
                                        <span class="label label-danger">{{ trans('request.too_late') }}</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('request-detail', $request->id) }}"><i class="icon-eye-open"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </section>
        </section>
    </section>
@endsection
