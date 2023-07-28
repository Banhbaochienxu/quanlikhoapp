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
                    <option value="{{ $item->tenCongty }}"{{ request()->tencongty==$item->tenCongty?'selected':false }}>{{ $item->tenCongty }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <input placeholder="Nhập ngày... vd:2023-1-1" type="date" class="form-control" name="dateStart" value="{{ request()->dateStart }}">
        </div>
        <div class="col-2">
            <input placeholder="Nhập ngày... vd:2023-1-1" type="date" class="form-control" name="dateEnd" value="{{ request()->dateEnd }}">
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
        <th>Số xe</th>
        <th>Nhân viên kiểm</th>
        <th>Kho</th>
        <th>Số lượng</th>
        <th>Net</th>
        <th>Đơn giá</th>
        <th>Trọng lượng</th>
        <th>Ngày xuất</th>
    </thead>
    <tbody>
        @foreach ($allXuat as $item)
        @php
            $date = date('d/m/Y H:i:s',strtotime($item->created_at));   
        @endphp
        <tr>
            <td>{{ $item->tenhang }}</td>
            <td>{{ $item->tenkhachhang }}</td>            
            <td>{{ $item->soxe }}</td>
            <td>{{ $item->nhanvien }}</td>
            <td>{{ $item->kho }}</td>
            <td>{{ $item->soluong }}</td>
            <td>{{ $item->net }}</td>
            <td>{{ $item->dongia}}</td>
            <td>{{ $item->trongluong}}</td>
            <td>{{ $date }}</td>
            <td>
                <div class="col-6">
                    <form method="post" class="" action="{{ route('trangchu.baocao.deletexuat',['id'=>$item->id]) }}">
                        @csrf
                        @method('delete')
                        <button onclick="return confirm('bạn có chắc muốn xóa?')" type="submit" class="btn btn-secondary">Xóa</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
        @if ($allXuat->count()==0)
            <td style="text-align: center;" colspan="9">---Không có dữ liệu---</td>
        @endif       
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $allXuat->links() }}
</div>
<a href="{{ route('trangchu.baocao.index') }}" class="btn btn-danger">Quay lại</a>