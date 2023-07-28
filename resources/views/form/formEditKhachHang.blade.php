
<form action="{{ route('trangchu.khachhang.updatekhachhang') }}" method="post">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="tencongty">Tên công ty</label>
        <input type="text" class="form-control" name="tencongty" placeholder="Nhập tên công ty..." value="{{ old('tencongty')??$khachhangDetail->tenCongty }}">
        @error('tencongty')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
        </div>
    <div class="form-group">
        <label for="macongty">Mã công ty</label>
            <input type="text" class="form-control" name="macongty" placeholder="Nhập tên công ty..." value="{{ old('macongty')??$khachhangDetail->maCongTy }}">
            @error('macongty')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
         </div>         
    <div class="form-group">
        <label for="sothue">Số thuế</label>
        <input type="number" class="form-control" id="sothue" name="sothue" placeholder="Nhập số thuế..." value="{{ old('sothue')??$khachhangDetail->soThue }}">
        @error('sothue')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="diachi">Địa chỉ</label>
        <input class="form-control" name="diachi" id="diachi" cols="10" rows="10" placeholder="Nhập địa chỉ.." value="{{ old('diachi')??$khachhangDetail->diaChi }}">
        @error('diachi')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="sdt">Số điện thoại</label>
        <input type="number" class="form-control" id="sdt" name="sdt" placeholder="Nhập số điện thoại..." value="{{ old('sdt')??$khachhangDetail->sdt }}">
        @error('sdt')
            <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
        @enderror
    </div>
    <div class="pt-2">
        <button class="btn btn-success">nhập</button>
        <a class="btn btn-danger" href="{{ route('trangchu.khachhang.showkhachhang') }}">Quay lại</a>
    </div>
</form>