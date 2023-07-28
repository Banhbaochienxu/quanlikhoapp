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
        <th>Mã hàng</th>
        <th>Tên hàng</th>
        <th width=150></th>
    </thead>
    <tbody>
        @foreach ($allHangHoa as $item)
        <tr>
            <td>{{ $item->mahang }}</td>
            <td>{{ $item->tenhang }}</td>
            <td>
                <div class="row">                  
                    <div class="col-6">
                        <a class="btn btn-secondary" href="{{ route('trangchu.hanghoa.edithanghoa',['id'=>$item->id]) }}">Sửa</a>
                    </div>
                        <div class="col-6">
                            <form method="post" class="" action="{{ route('trangchu.hanghoa.deletehanghoa',['id'=>$item->id]) }}">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('bạn có chắc muốn xóa?')" type="submit" class="btn btn-secondary">Xóa</button>
                            </form>
                    </div>
                </div>              
            </td>      
        </tr>
        @endforeach    
        @if ($allHangHoa->count()==0)
            <td style="text-align: center;" colspan="9">---Không có dữ liệu---</td>
        @endif     
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $allHangHoa->links() }}
</div>
<a href="{{ route('trangchu.hanghoa.index') }}" class="btn btn-danger">Quay lại</a>