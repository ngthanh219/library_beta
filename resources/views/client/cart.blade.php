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
                    <h2>SHOPPING CART</h2>
                    <span class="h-line"></span>
                </div>
                <div class="cart-table-holder">
                    @if (!session('cart'))
                        <tr>
                            <td colspan="6">
                                <h4>{{ trans('book.empty_information') }}</h4>
                            </td>
                        </tr>
                    @else
                        <form action="{{ route('request') }}" method="POST">
                            <table class="cart-table-general" border="0" cellpadding="10">
                                <tr>
                                    <th class="col-first-table">&nbsp;</th>
                                    <th class="col-second-table" align="left">Product Name</th>
                                    <th class="col-third-table">&nbsp;</th>
                                </tr>
                                @foreach ($cart as $item)
                                    <tr bgcolor="#FFFFFF" class=" product-detail">
                                        <td valign="top"><img src="{{ asset('upload/book/' . $item['image']) }}" /></td>
                                        <td valign="top">{{ $item['name'] }}</td>
                                        <td align="center" valign="top">
                                            <a href="{{ $item['id'] }}" class="remove-item"><i class="icon-trash"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                            <div class="cart-option-box">
                                @csrf
                                <p>Borrow Date</p>
                            <input type="date" id="inputDiscount" name="borrowed_date" value="{{ old('borrowed_date') }}">
                                @if ($errors->has('borrowed_date'))
                                    <span class="red">{{ $errors->first('borrowed_date') }}</span>
                                @endif
                                <p>Return Date</p>
                                <input type="date" id="inputDiscount" name="return_date" value="{{ old('return_date') }}">
                                @if ($errors->has('borrowed_date'))
                                    <span class="red">{{ $errors->first('borrowed_date') }}</span>
                                @endif
                                <br class="clearfix">
                                <textarea name="note">{{ old('note') }}</textarea>
                                <br class="clearfix">
                                <button type="submit" class="more-btn">Request</a>
                            </div>
                        </form>
                    @endif
                </div>
            </section>
        </section>
    </section>
    <script src=" {{ asset('js/remove_cart.js') }} " defer></script>
@endsection
