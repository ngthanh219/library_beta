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
                    <h2>Detail Request</h2>
                    <span class="h-line"></span>
                </div>
                <div class="cart-table-holder">
                    <section class="span3">
                        <ul class="list-group list-group-unbordered">
                            <li>
                                <b>{{ trans('user.email') }}</b> <a class="pull-right">{{ $request->user->email }}</a>
                            </li>
                            <li>
                                <b>{{ trans('user.phone') }}</b> <a
                                    class="pull-right">{{ $request->user->phone ? $request->user->phone : 'Unknow' }}</a>
                            </li>
                            <li>
                                <b>{{ trans('user.address') }}</b> <a class="pull-right">{{ $request->user->address }}</a>
                            </li>
                            <li>
                                <b>Ngày mượn:</b><a class="pull-right">{{ $request->borrowed_date }}</a>
                            </li>
                            <li>
                                <b>Ngày trả:</b><a class="pull-right">{{ $request->borrowed_date }}</a>
                            </li>
                            <li>
                                <b>Số ngày còn lại:</b><a class="pull-right">
                                    @php
                                    $start_time = \Carbon\Carbon::parse($request->borrowed_date);
                                    $finish_time = \Carbon\Carbon::parse($request->return_date);
                                    $total_date = $finish_time->diffinDays($start_time);
                                    @endphp
                                    {{ $total_date }}
                                    {{ trans('request.days') }}
                                </a>
                            </li>
                            <li>
                                <b>Tình trạng: <b>
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
                                        @endif
                                    </b>
                                </b>
                            </li>
                        </ul>
                    </section>
                    <table class="cart-table-general" border="0" cellpadding="10">
                        <tr>
                            <th class="col-first-table">Image</th>
                            <th class="col-second-table" align="left">Book Name</th>
                        </tr>
                        @foreach ($request->books as $book)
                            <tr bgcolor="#FFFFFF" class=" product-detail">
                                <td valign="top"><img src="{{ asset('upload/book/' . $book->image) }}" /></td>
                                <td valign="top">{{ $book->name }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </section>
        </section>
    </section>
    <script src=" {{ asset('js/remove_cart.js') }} " defer></script>
@endsection
