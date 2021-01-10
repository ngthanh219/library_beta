<!DOCTYPE html>
<html>

<head>
    <title>Book Store</title>
    @include('client.modules.header')
</head>

<body>
    <div class="wrapper">
        <div class="notification-client">
        </div>
        @include('client.modules.top_nav_bar')
        @include('client.modules.nav_bar')
        <section id="content-holder" class="container-fluid container">
            <section class="row-fluid">
                <div class="heading-bar">
                    <h2>Grid View</h2>
                    <span class="h-line"></span>
                </div>
                <section class="span9 first wapper">
                    @yield('content')
                </section>
                @if (Route::current()->getName() != 'cart')
                    <section class="span3">
                        <div class="side-holder">
                            <article class="shop-by-list">
                                <h2>Shop by</h2>
                                <div class="side-inner-holder">
                                    @include('client.category')
                                    @include('client.author')
                                </div>
                            </article>
                        </div>
                    </section>
                @endif
            </section>
        </section>
        @include('client.modules.trending')
    </div>
    @include('client.modules.footer')
</body>

</html>
