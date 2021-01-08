<section class="top-nav-bar">
    <section class="container-fluid container">
        <section class="row-fluid">
            <section class="span6">
                <ul class="top-nav">
                    <li><a href="{{ route('home') }}" class="active">Home page</a></li>
                </ul>
            </section>
            <section class="span6 e-commerce-list">
                <ul>
                    @if (Auth::check())
                        <li>Welcome {{ Auth::user()->name }}!
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"><a>Log out</a></button>
                            </form>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}">Login</a> or <a href="checkout.html">
                                Create an account
                            </a>
                        </li>
                    @endif
                    <li class="p-category">
                        <a href="#">eng</a>
                        <a href="#">de</a>
                        <a href="#">fr</a>
                    </li>
                </ul>
                <div class="c-btn"> <a href="{{ route('cart') }}" class="cart-btn">Cart</a>
                    <div class="btn-group">
                        <button data-toggle="dropdown" class="btn btn-mini dropdown-toggle">
                            book(s)
                        </button>
                    </div>
                </div>
            </section>
        </section>
    </section>
</section>
