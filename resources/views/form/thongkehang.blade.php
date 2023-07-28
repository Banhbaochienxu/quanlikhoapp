<form action="" method="get">
    <div class="row">
        <div class="col-3">
            <select class="form-select" id="tenhang" name="tenhang">
                <option value="0">--Tên hàng--</option>
                @foreach ($allHang as $item)
                    <option value="{{ $item->tenhang }}"{{ request()->tenhang==$item->tenhang?'selected':false }}>{{ $item->tenhang }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-3">
            <select class="form-select" id="tencongty" name="tencongty">
                <option value="0">--Tên công ty--</option>
                @foreach ($allKhachHang as $item)
                    <option value="{{ $item->maCongTy }}"{{ request()->tencongty==$item->maCongTy?'selected':false }}>{{ $item->tenCongty }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-4">
            <input placeholder="Tìm kiếm sản phẩm..." type="text" class="form-control" name="keywords" value="{{ request()->keywords }}">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </div>
</form>
<table style="width: 900px" class="table table-striped pt-3">
    <thead>
        <th>Tên hàng</th>
        <th>Tên khách hàng</th>
        <th>Số lượng</th>
    </thead>
    <tbody>
        @php
            $tonghang =0;
        @endphp
        @foreach ($allTonKho as $item)
        <tr>
            <td>{{ $item->tenhang }}</td>
            <td>{{ $item->idkhachhang }}</td>
            <td>{{ $item->soluong }}</td>
            @php
                $tonghang +=$item->soluong;
            @endphp
        </tr>
        @endforeach  
        @if ($allTonKho->count()==0)
            <td style="text-align: center;" colspan="9">---Không có dữ liệu---</td>
        @endif       
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $allTonKho->links() }}
</div>
<div class="d-flex justify-content-end">
    Tống hàng trong kho:{{ $tonghang }}
</div>
<a href="{{ route('trangchu.baocao.index') }}" class="btn btn-danger">Quay lại</a>