<form action="" method="get">
    <div class="row">
        <div class="col-3">
           
        </div>
        <div class="col-3">
            
        </div>
        <div class="col-4">
            <input placeholder="Tìm kiếm hàng..." type="text" class="form-control" name="keywords" value="{{ request()->keywords }}">
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-primary">Tìm kiếm</button>
        </div>
    </div>
</form>
<table style="width: 900px" class="table table-striped pt-3">
    <thead>
        <th>Tên công ty</th>
        <th>Số thuế</th>
        <th>Mã công ty</th>
        <th>Địa chỉ</th>
        <th>Số điện thoại</th>
    </thead>
    <tbody>
        @foreach ($allKhachHang as $item)
            <tr>
                <td>{{ $item->tenCongty }}</td>
                <td>{{ $item->soThue}}</td>
                <td>{{ $item->maCongTy }}</td>
                <td>{{ $item->diaChi }}</td>
                <td>{{ $item->sdt }}</td>
                <td>
                    <div class="row">                  
                        <div class="col-6">
                            <a class="btn btn-secondary" href="{{ route('trangchu.khachhang.editkhachhang',['id'=>$item->id]) }}">Sửa</a>
                        </div>
                            <div class="col-6">
                                <form method="post" class="" action="{{ route('trangchu.khachhang.deletekhachang',['id'=>$item->id]) }}">
                                    @csrf
                                    @method('delete')
                                    <button onclick="return confirm('bạn có chắc muốn xóa?')" type="submit" class="btn btn-secondary">Xóa</button>
                                </form>
                        </div>
                    </div>              
                </td>
            </tr>
        @endforeach
        @if ($allKhachHang->count()==0)
            <td style="text-align: center;" colspan="9">---Không có dữ liệu---</td>
        @endif         
    </tbody>
</table>
<a href="{{ route('trangchu.khachhang.index') }}" class="btn btn-danger">Quay lại</a>