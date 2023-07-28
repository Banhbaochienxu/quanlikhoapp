<form action="{{ route('trangchu.quanlytaikhoan.postuser') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name"></label>
        <input placeholder="Nhập tên tài khoản..." class="form-control" type="text" name="name" id="name" value="{{ old('name') }}">
        @error('name')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email"></label>
        <input placeholder="Nhập Email..." class="form-control" type="text" name="email" id="email" value="{{ old('email') }}">
        @error('email')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>           
        @enderror
    </div>
    <div class="form-group">
        <label for="level"></label>
        <select class="form-control" name="level" id="level">
            <option disabled selected value="">--Chọn quyền--</option>
            <option {{ old('level')==1?'selected':false }} value="1">User</option>
            <option {{ old('level')==2?'selected':false }} value="2">Admin</option>
        </select>
        @error('level')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>           
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd"></label>
        <input placeholder="Nhập mật khẩu..." class="form-control" type="password" name="pwd" id="pwd" value="{{ old('pwd') }}">
        @error('pwd')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>            
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd2"></label>
        <input placeholder="Xác nhận mật khẩu..." class="form-control" type="password" name="pwd2" id="pwd2" value="{{ old('pwd2') }}">
        @error('pwd2')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>            
        @enderror
    </div>
    <button type="submit" class="btn btn-success mt-3">Xác nhận</button>
    <a href="{{ route('trangchu.quanlytaikhoan.index') }}" class="btn btn-danger mt-3">Quay lại</a>
</form> 