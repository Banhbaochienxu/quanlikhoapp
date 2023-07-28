<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js" integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div style="background: #1c6e8c" class="p-2 d-flex justify-content-end">
            <div class="btn-group">
                @if (!empty($userLogin))
                    {{ $userLogin }}
                @endif
                <button style="background: #1c6e8c;color: #fcfbff" type="button" class="btn">{{ Auth::user()->name ?? '' }}</button>
                <button style="background: #1c6e8c; border: none; box-shadow: none" type="button" class="btn btn-danger dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                  <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="{{ route('trangchu.thongtinuser') }}">Thông tin tài khoản</a></li>
                  @if (Auth::user()->level == 2)
                  <li><a class="dropdown-item" href="{{ route('trangchu.quanlytaikhoan.index') }}">Quản lý tài khoản</a></li>             
                  @endif
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('trangchu.logout') }}">Đăng xuất</a></li>
                </ul>
              </div>
        </div>
    </header>
    <main>
        <div style="height: 92vh;background: #D0CCD0" class="content">
            @yield('content')
        </div>
    </main>
</body>
</html>