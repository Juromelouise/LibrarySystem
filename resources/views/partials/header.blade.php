<nav class="navbar navbar-expand-lg navbar-light bg-danger">
    <a class="navbar-brand" href="{{ route('getItems') }}">New York Library</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    @guest
                        Guest
                    @else
                        {{ Auth::user()->name }}
                    @endguest
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                    @guest
                        <a class="dropdown-item" href="{{ route('register') }}">Signup</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Signin</a>
                    @else
                        @if (Auth::user()->role == '1')
                            <a class="dropdown-item" href="{{ route('user.index') }}">Accounts</a>
                        @else
                            <a class="dropdown-item" href="{{ route('user.index') }}">User Profile</a>
                        @endif
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                    @endguest
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
            @if (Auth::check() && Auth::user()->role === '1')
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="crudDropdown" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user-circle"></i>
                        CRUD
                    </a>
                    <div class="dropdown-menu" aria-labelledby="crudDropdown">
                        <a class="dropdown-item" href="{{ route('genre.index') }}">Genre</a>
                        <a class="dropdown-item" href="{{ route('author.index') }}">Author</a>
                        <a class="dropdown-item" href="{{ route('book.index') }}">Book</a>
                        <a class="dropdown-item" href="{{ route('stock.index') }}">Stock</a>
                        <a class="dropdown-item" href="{{ route('order.confirmation') }}">Confrim orders</a>
                        <div class="dropdown-divider"></div>
                        <a class="nav-link dropdown-toggle" href="#" id="nestedDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            DataTables
                        </a>
                        <div class="dropdown-menu" aria-labelledby="nestedDropdown">
                            <a class="dropdown-item" href="{{ route('books.table') }}">Book</a>
                            <a class="dropdown-item" href="{{ route('stock.table') }}">Stock</a>
                            <a class="dropdown-item" href="{{ route('author.table') }}">Author</a>
                        </div>
                    </div>
            @endif
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="crudDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="bi bi-flag"></i>
                    Reports
                </a>
                <div class="dropdown-menu" aria-labelledby="crudDropdown">
                    <a class="dropdown-item" href="{{ route('user.history') }}">History</a>
                    <a class="dropdown-item" href="{{ route('most.used') }}">Most Used</a>
                    <a class="dropdown-item" href="{{ route('chart') }}">Chart</a>
                    <div class="dropdown-divider"></div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('viewCheckout') }}">
                    <i class="fa fa-book" aria-hidden="true" style="font-size:20px;color:#A4E9D5"></i>
                    <span class="text-color" style="color: #A4E9D5;">Checkout</span>
                    <span
                        class="badge badge-secondary">{{ Session::has('checkout') ? array_sum(array_column(Session::get('checkout'), 'quantity')) : '' }}</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('borrow') }}">
                    <i class="fa fa-book" aria-hidden="true" style="font-size:20px;color: #40e0d0"></i>
                    <span class="text-color" style="color: #40e0d0;">Borrow</span>
                </a>
            </li>
        </ul>
        <div class="ui-widget">
            <form action="{{ route('books.search') }}" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id="tags" type="search" name="term" placeholder="Search"
                    aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
