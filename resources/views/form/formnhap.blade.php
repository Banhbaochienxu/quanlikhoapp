<form action="{{ route('trangchu.postnhap') }}" method="post">
    @csrf
    <div class="row  ">
        <div class="col-6">
            <div class="form-group">
                <label for="tenhang">Tên hàng</label>
                <input placeholder="Tìm hàng xuất..." type="text" list="ide" class="form-control" name="tenhang" value="{{ old('tenhang') }}">
                <datalist  id="ide">
                    @if (!empty($allHang))
                        @foreach ($allHang as $item)
                            <option value="{{ $item->tenhang }}" {{ old('tenhang')==$item->tenhang?'selected':false }}>{{ $item->mahang }}</option>
                        @endforeach                       
                    @endif
                </datalist>
                <a style="font-size: 0.75rem" id="btnthemdonvi" class="btn" onclick="themhang()">Thêm mới hàng</a>
            </div>
            @error('tenhang')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="name">Tên khách hàng</label>
                <select name="idkhachhang" id="idkhachhang" class="form-control">
                    <option selected disabled value="">--Chọn khách hàng--</option>
                    @if (!empty($allKhachHang))
                        @foreach ($allKhachHang as $item)
                            <option value="{{ $item->maCongTy }}" {{ old('khachhang')==$item->maCongTy?'selected':false }}>{{ $item->tenCongty }}</option>
                        @endforeach                       
                    @endif
                </select>
            </div>
            @error('tenhang')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row ">
        <div class="col-6">
            <div class="form-group">
                <label for="kho">kho</label>
                <input type="number" class="form-control" id="kho" name="kho" placeholder="Nhập kho nhập..." value="{{ old('kho') }}">
            </div>
            @error('kho')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="soxe">Số xe</label>
                <input type="text" class="form-control" id="soxe" name="soxe" placeholder="Nhập số xe..." value="{{ old('soxe') }}">
            </div>
            @error('soxe')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row pb-2">
        <div class="col-6">
            <div class="form-group">
                <label for="soluong">Số lượng</label>
                <input type="number" class="form-control" id="soluong" name="soluong" placeholder="Nhập số lượng..." value="{{ old('soluong') }}">
            </div>
            @error('soluong')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="net">NET</label>
                <input type="number" class="form-control" id="net" name="net" placeholder="Nhập NET..." value="{{ old('net') }}">
            </div>
            @error('net')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="nhanvien">Nhân viên kiểm</label>
                <input type="text" class="form-control" id="nhanvien" name="nhanvien" placeholder="Nhập nhân viên kiểm..." value="{{ old('nhanvien') }}">
                @error('nhanvien')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="name">đơn vị tính</label>
                <select name="donvi" id="donvi" class="form-control">
                    <option value="Thùng">--Chọn đơn vị--</option>
                    @if (!empty($allDonVi))
                        @foreach ($allDonVi as $item)
                            <option value="{{ $item->tendonvi }}" {{ old('khachhang')==$item->tendonvi?'selected':false }}>{{ $item->tendonvi }}</option>
                        @endforeach                       
                    @endif
                </select>
                <a style="font-size: 0.75rem" id="btnthemdonvi" class="btn" onclick="themdonvi()">Thêm mới đơn vị</a>
            </div>
            @error('tenhang')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="ghichu">Ghi chú</label>
        <textarea style="height: 100px" class="form-control" name="ghichu" id="ghichu" cols="10" rows="10" placeholder="Nội dung ghi chú..." value="{{ old('ghichu') }}"></textarea>
    </div>
    <div class="pt-2">
        <button class="btn btn-success">nhập</button>
    </div>
</form>
<div style="display:none" id="popupthemdonvi" class="popup">
    <div class="popup_content">
    <button type="button" class="btn-close float-end js-thoat"></button>
    <div class="popup-heading mt-3">
            <h2 class="text-center">Thêm đơn vị</h2>
            @if ($errors->any())
                <div class="row container">
                    <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
                </div>
            @endif
        </div>
        <div class="panel-body pt-3">
            <div class="container">
                <form action="{{ route('trangchu.postdonvi') }}" method="post">
                    @csrf
                    <input placeholder="nhập đơn vị mới..." class="form-control" type="text" name="tendonvi" id="tendonvi" value="{{ old('tendonvi') }}">
                    <button type="submit" class="btn btn-success mt-2">Thêm</button>
                </form>
            </div>
        </div>
    </div>
</div>
<div style="display:none" id="popupthemhang" class="popup">
    <div class="popup_content">
    <button type="button" class="btn-close float-end js-thoat"></button>
    <div class="popup-heading mt-3">
            <h2 class="text-center">Thêm hàng hóa</h2>
            @if ($errors->any())
                <div class="row container">
                    <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
                </div>
            @endif
        </div>
        <div class="panel-body pt-3">
            <div class="container">
                <form action="{{ route('trangchu.postaddhanghoa') }}" method="post">
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
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function themdonvi(){
        let popupthemdonvi = document.getElementById('popupthemdonvi');

        popupthemdonvi.style.display = 'block';
    }
    function themhang(){
        let popupthemhang = document.getElementById('popupthemhang');

        popupthemhang.style.display = 'block';
    }
    function closeDonvi(){
        popupthemdonvi.style.display = 'none';
        popupthemhang.style.display = 'none';
    }
    let thoats = document.querySelectorAll('.js-thoat');
    // for
    //     thoat.addEventListener('click',closeDonvi)

    for(let thoat of thoats){
        thoat.addEventListener('click',closeDonvi)
    }   
</script>