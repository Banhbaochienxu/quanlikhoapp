<form action="{{ route('trangchu.postxuat') }}" method="post">
    @csrf
    <div class="row">
        <div class="form-group">
            <label for="tencongty">Tên khách hàng</label>
                <select class="form-control" name="tencongty" id="tencongty">
                    <option selected disabled value="">--chọn công ty--</option>
                    @if (!empty($allTonKho))
                        @php
                            $allTenCongTy = [];
                        @endphp
                        @foreach ($allTonKho as $item)
                            @php                               
                                if(in_array($item->tencongty,$allTenCongTy)){
                                    continue;
                                }
                                else {
                                    echo "<option value='$item->tencongty'>$item->tencongty</option>";
                                    array_push($allTenCongTy,$item->tencongty);
                                }
                            @endphp
                        @endforeach                      
                    @endif
                </select>
            @error('tencongty')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>
    </div>
        <div class="row">
            <div class="form-group">
                <label for="tenhang">Hàng xuất</label>
                    <select class="form-control" name="tenhang" id="tenhang">
                        <option selected disabled value="">--chọn tên hàng--</option>
                    </select>
                @error('tenhang')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>  
    </div>   
    <div class="row">
        <div class="form-group">
            <label for="kho">kho</label>
                <select class="form-control" name="kho" id="kho">
                    <option selected disabled value="">--chọn kho--</option>                   
                </select>
            @error('kho')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>  
    </div>  
    <div class="row">
        <div class="form-group">
            <label for="ngaynhap">Ngày nhập</label>
                <select class="form-control" name="ngaynhap" id="ngaynhap">
                    <option selected disabled value="">--Ngày nhập--</option>                   
                </select>
            @error('ngaynhap')
                <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
            @enderror
        </div>  
    </div>    
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="soxe">Số xe</label>
                <input placeholder="Nhập số xe..." type="text" class="form-control" id="soxe" name="soxe" value="{{ old('soxe') }}">
                @error('soxe')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="nhanvien">Nhân viên</label>
                <input placeholder="Nhập tên nhân viên...." type="text" class="form-control" id="nhanvien" name="nhanvien" value="{{ old('nhanvien') }}">
                @error('nhanvien')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="soluong">Số lượng</label>
                <input placeholder="Nhập số lượng" type="number" class="form-control" id="soluong" name="soluong" value="{{ old('soluong') }}">
                @error('soluong')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="dongia">Đơn giá</label>
                <input placeholder="Nhập đơn giá" type="number" class="form-control" id="dongia" name="dongia" value="{{ old('dongia') }}">
                @error('dongia')
                    <span style="color: red;font-size: 0.75rem">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="pt-2">
        <button class="btn btn-success">xuất</button>
    </div>      
</form>
<script type="text/javascript">
    $('#tencongty').on('change',function(){
        var tencongty = $('#tencongty').val()
        $.ajax({
            type: 'get',
            url: '{{ URL::to('trangchu/xuat') }}',
            data: {
                tencongty:tencongty
            },
            success:function(data){
                $('#tenhang').html(data);
            }
        });
    })
    $('#tenhang').on('change',function(){
        var tencongty = $('#tencongty').val();
        var tenhang = $('#tenhang').val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('trangchu/xuat') }}',
            data: {
                tencongty:tencongty,
                tenhang:tenhang
            },
            success:function(data){
                $('#kho').html(data);
            }
        });
    })
    $('#kho').on('change',function(){
        var tencongty = $('#tencongty').val();
        var tenhang = $('#tenhang').val();
        var kho = $('#kho').val();
        $.ajax({
            type: 'get',
            url: '{{ URL::to('trangchu/xuat') }}',
            data: {
                tencongty:tencongty,
                tenhang:tenhang,
                kho:kho,
            },
            success:function(data){
                $('#ngaynhap').html(data);
            }
        });
    })
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
