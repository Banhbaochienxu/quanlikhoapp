00000000<form action="{{ route('trangchu.quanlytaikhoan.updateuser') }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="name">Tên tài khoản</label>
        <input placeholder="Nhập tên tài khoản..." class="form-control" type="text" name="name" id="name" value="{{ old('name')?? $userDetail->name }}">
        @error('name')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input placeholder="Nhập Email..." class="form-control" type="text" name="email" id="email" value="{{ old('email')?? $userDetail->email }}">
        @error('email')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>           
        @enderror
    </div>
    <div {{ $userDetail->id==1||Auth::user()->level==1?'hidden':false }} class="form-group">
        <label for="level">Quyền</label>
        <select class="form-control" name="level" id="level">
            <option disabled selected value="">--Chọn quyền--</option>
            <option {{ $userDetail->level==1?'selected':false }} value="1">User</option>
            <option {{ $userDetail->level==2?'selected':false }} value="2">Admin</option>
        </select>
        @error('level')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>           
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd">Mật khẩu</label>
        <input placeholder="Nhập mật khẩu..." class="form-control" type="password" name="pwd" id="pwd" value="{{ old('pwd')?? $userDetail->password }}">
        @error('pwd')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>            
        @enderror
    </div>
    <div class="form-group">
        <label for="pwd2">Xác nhận mật khẩu</label>
        <input placeholder="Xác nhận mật khẩu..." class="form-control" type="password" name="pwd2" id="pwd2" value="{{ old('pwd2')??$userDetail->password    }}">
        @error('pwd2')
            <span style="color:red;font-size: 0.75rem">{{ $message }}</span>            
        @enderror
    </div>
    <button type="submit" class="btn btn-success mt-3">Xác nhận</button>
    <a href="{{ route('trangchu.quanlytaikhoan.index') }}" class="btn btn-danger mt-3">Quay lại</a>
</form> 