<form action="{{ route('trangchu.hanghoa.posthanghoa') }}" method="post">
    @csrf
    <div class="form-group">
        <label for="mahang">Mã hàng</label>
        <input placeholder="nhập mã hàng..." class="form-control" type="text" name="mahang" id="mahang" value="{{ old('mahang') }}">
        @error('mahang')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="tenhang">Tên hàng</label>
        <input placeholder="nhập tên hàng" class="form-control" type="text" name="tenhang" id="tenhang" value="{{ old('tenhang') }}">
        @error('tenhang')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror       
    </div>
    <button type="submit" class="btn btn-success mt-2">Thêm</button>
    <a href="{{ route('trangchu.hanghoa.index') }}" class="btn btn-danger mt-2">Quay lại</a>

</form>