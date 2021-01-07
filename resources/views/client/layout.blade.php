<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

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
            </section>
        </section>
        @include('client.modules.trending')
    </div>
    @include('client.modules.footer')
</body>
</html>
