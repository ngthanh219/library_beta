@extends('client.layout')
@section('content')
    <section id="content-holder" class="container-fluid container">
        <section class="row-fluid">
            <section class="span9 cart-holder">
                <div class="heading-bar">
                    <h2>SHOPPING CART</h2>
                    <span class="h-line"></span>
                </div>
                <div class="cart-table-holder">
                    @if (!session('cart'))
                        <tr>
                            <td colspan="6">
                                <h4>Không có sản phẩm nào trong giỏ</h4>
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
                                <input type="date" id="inputDiscount" name="borrowed_date">
                                <p>Return Date</p>
                                <br class="clearfix">
                                <input type="date" id="inputDiscount" name="return_date">
                                <br class="clearfix">
                                <textarea name="note"></textarea>
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
