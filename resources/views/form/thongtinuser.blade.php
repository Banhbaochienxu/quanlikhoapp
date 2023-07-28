<form action="" method="get">
    <div class="form-group p-2">
        <label for="">Tên: {{ Auth::user()->name }}</label>
    </div>
    <div class="from-group p-2">
        <label for="">Email: {{ Auth::user()->email }}</label>       
    </div>
    <div class="from-group p-2">      
        @if (Auth::user()->level == 2)
            <label for="">Quyền: admin</label>
        @else ()
            <label for="">Quyền: user</label>
        @endif
    </div>
    <a href="{{ route('trangchu.quanlytaikhoan.edituser',['id'=>Auth::user()->id]) }}" class="btn btn-primary mt-2">Cập nhật thông tin</a>
</form>