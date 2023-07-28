<a href="{{ route('trangchu.quanlytaikhoan.getuser') }}" class="btn btn-success">Thêm</a>
<table  class="table table-striped pt-3">
    <thead>
        <th>Tên</th>
        <th>Email</th>
        <th>Quyền</th>
        <th>Ngày tạo</th>
        <th>Thao tác</th>
    </thead>
    <tbody>
        @foreach ($allUser as $item)
        @php
            $date = date('d/m/Y H:i:s',strtotime($item->created_at));
            if ($item->level==2) {
               $quyen = 'Admin';
            }
            else {
                $quyen = 'user';
            }
        @endphp
        <tr>
            <td>{{ $item->name }}</td>
            <td>{{ $item->email }}</td>
            <td>{{ $quyen }}</td>
            <td>{{ $item->created_at }}</td>
            <td>
                @if ($item->id !=1)
                <div class="row">                  
                    <div class="col-6">
                        <a class="btn btn-secondary" href="{{ route('trangchu.quanlytaikhoan.edituser',['id'=>$item->id]) }}">Sửa</a>
                    </div>
                        <div class="col-6">
                            <form method="post" class="" action="{{ route('trangchu.quanlytaikhoan.deleteuser',['id'=>$item->id]) }}">
                                @csrf
                                @method('delete')
                                <button onclick="return confirm('bạn có chắc muốn xóa?')" type="submit" class="btn btn-secondary">Xóa</button>
                            </form>
                        </div>
                        
                    </div>              
                @endif
            </td>
        </tr>
        @endforeach
         @if ($allUser->count()==0)
            <td style="text-align: center;" colspan="9">---Không có dữ liệu---</td>
        @endif            
    </tbody>
</table>
<div class="d-flex justify-content-end">
    {{ $allUser->links() }}
</div>