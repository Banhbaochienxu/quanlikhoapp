<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/loginStyle.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css')}}">
    <title>Đăng nhập</title>
</head>
<body>
     @if ($errors->any())
      <div class="notification">
          <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!
            <button style="font-size: 0.75rem;" type="button" class="btn-close js-thoat" aria-label="Close"></button>
          </div>          
      </div>        
     @endif
    @if (session('msg'))
      <div class="notification">
          <div class="alert alert-{{ session('status') }}">{{ session('msg') }}
            <button style="font-size: 0.75rem;" type="button" class="btn-close js-thoat" aria-label="Close"></button>
          </div>
      </div>
    @endif
    <div style="height: 100vh;" class="d-flex align-items-center justify-content-center flex-column">
        <img src="{{ asset('img/logo.png') }}">
        <form action="{{ route('postlogin') }}" method="post" style="width:400px;" class="border m-auto p-2 shadow login">
          @csrf
          <h5 class="text-center m-4">ĐĂNG NHẬP</h5>
          <div class="form-group mt-3">
            <input required="true" type="text" class="input" id="name" name="name">
            <label class="label" for="name">Tên Đăng nhập</label>
          </div>          
          <div class="form-group my-3">
            <input required="true" type="password" class="input" id="pwd" name="pwd">
            <label class="label" for="name">Password</label>
            @error('pwd')
                <span style="color: red;font-size: 0.75rem;margin-left: 40px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group form-check">
            <label class="form-check-label">
              <input style="margin-left:20px;" class="form-check-input" name="remember" id="remember" type="checkbox">
              <p style="margin-left:45px;">Ghi nhớ</p>
            </label>
          </div>
          <button style="width:300px;" type="submit" class="btn btn-primary input" name="login" value="login">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
<script>
  const btnthoat = document.querySelector('.js-thoat')
  let notification = document.querySelector('.notification')
  function thoat(){
    notification.style.display = 'none';
  }

  btnthoat.addEventListener('click',thoat)
</script>