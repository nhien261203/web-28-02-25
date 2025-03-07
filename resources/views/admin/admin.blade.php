<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('order.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('category.index') }}">Category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">Product</a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('admin.favorite.index')}}"> Favorites </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('admin.contact')}}"> Contact </a>
                    </li>
                    <li class="nav-item">
                        <a  class="nav-link" href="{{route('user.index')}}"> User </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('memberships.index') }}" >Membership</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('comments.index') }}" >Comment</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('blogs.index') }}" >Blog</a>
                    </li>

                </ul>
            </div>

            <div class="dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Xin chào, {{ Auth::user()->name }}
                </a>
                <div class="dropdown-menu">
                    <a href="{{ route('password_admin.change')}}" class="dropdown-item">Doi mat khau</a>



                    <a href="{{ route('logout') }}"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-success dropdown-item">
                        Đăng xuất
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>





    </nav>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success mt-3" role="alert">
                <h4 class="alert-heading">Thong bao</h4>
                <p>{{ Session::get('success') }}</p>
            </div>
        @endif

        @if (Session::has('warning'))
            <div class="alert alert-warning mt-3" role="alert">
                <h4 class="alert-heading">Thong bao</h4>
                <p>{{ Session::get('warning') }}</p>
            </div>
        @endif

        @if (Session::has('ok'))
            <div class="alert alert-warning mt-3" role="alert">
                <h4 class="alert-heading">Thong bao</h4>
                <p>{{ Session::get('ok') }}</p>
            </div>
        @endif
        @if (Session::has('no'))
                <div class="alert alert-danger mt-3" role="alert">
                    <h4 class="alert-heading">Thong bao</h4>
                    <p>{{ Session::get('no') }}</p>
                </div>
        @endif
        @yield('main')
    </div>
</body>

</html>
