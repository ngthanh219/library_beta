@extends('client.layout')
@section('content')
    <section class="b-detail-holder">
        <article class="title-holder">
            <h4><i class="icon-ok"></i> Your order has been recieved</h4>
        </article>

        <section class="reviews-section">
            <figure class="right-sec r-border">
                <span class="green-t">Thank for your purchase!</span>
                <p>Your order # is: 100000261.<br />
                    You will receive an order confirmation email with details of your order and link to track it’s
                    progress.<br />
                    Click here to print a copy of your order confirmation.</p>
                <a href="grid-view.html" class="more-btn ">Continue Shopping</a>
            </figure>
            <figure class="left-sec">
                <div class="r-title-bar">
                    <strong class="green-t">My Orders</strong>
                </div>
                <ul class="order-list">
                    <li>
                        <label class="checkbox">
                            <input type="checkbox"> <span>The Kite Runner</span><br /> by Khalid Hosseini
                        </label>
                    </li>
                    <li>
                        <label class="checkbox">
                            <input type="checkbox"> <span>The Kite Runner</span><br /> by Khalid Hosseini
                        </label>
                    </li>
                    <li>
                        <label class="checkbox">
                            <input type="checkbox"> <span>The Kite Runner</span><br /> by Khalid Hosseini
                        </label>
                    </li>
                    <li>
                        <label class="checkbox">
                            <input type="checkbox"> <span>The Kite Runner</span><br /> by Khalid Hosseini
                        </label>
                    </li>
                    <li>
                        <a href="#">View All</a>
                    </li>
                </ul>
                <a href="cart.html" class="grey-btn">+ Add to Cart</a>
            </figure>
        </section>
    </section>
@endsection
