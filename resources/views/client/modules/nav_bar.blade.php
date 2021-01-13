<header id="main-header">
    <section class="container-fluid container">
        <section class="row-fluid">
            <section class="span4">
                <h1 id="logo"> <a href="{{ route('home') }}"><img
                            src="{{ asset('bower_components/book-client-lte/images/logo.png') }}" /></a> </h1>
            </section>
            <section class="span8">
                <ul class="top-nav2">
                    <li><a href="{{ route('request') }}">List Request</a></li>
                    <li><a href="{{ route('cart') }}">My Cart</a></li>
                </ul>
                <div class="search-bar">
                    <input name="" type="text" value="search entire store here..." />
                    <input name="" type="button" value="Serach" />
                </div>
            </section>
        </section>
    </section>

    <nav id="nav">
        <div class="navbar navbar-inverse">
            <div class="navbar-inner">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span>
                </button>
                <div class="nav-collapse collapse">
                    <ul class="nav">
                        <li> <a href="{{ route('home') }}">Books</a> </li>
                        <li class="dropdown">
                            <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                                <i class="icon-heart"></i> Features<b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">About Us</a></li>
                                <li><a href="#">Blog</a></li>
                            </ul>
                        </li>
                        <li class="dropdown"> <a class="dropdown-toggle" href="#" data-toggle="dropdown">Movies & TV <b
                                    class="caret"></b> </a>
                            <ul class="dropdown-menu">
                                <li><a href="#">Submenu Detail Column 1</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</header>
