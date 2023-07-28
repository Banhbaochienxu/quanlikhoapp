@extends('layout.layout_main')
@section('content')
    <div class="main">
        <div class="container">
            <div style="height: 500px;color: #1c6e8c" class="row bg-light rounded">
                <div  class="col-6 position-relative">
                    <div style="margin-left: 5rem" class="position-absolute top-50 start-0 translate-middle-y">
                        <h1>Phần mềm quản lý kho</h1>
                        <p>CÔNG TY TNHH THƯƠNG MẠI HỒNG PHÚ</p>
                        <p>Tên quốc tế: HONG PHU TRADING COMPANY LIMITED</p>
                        <p>Mã số thuế:	3500424838</p>
                        <p>Địa chỉ:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Số 1725 Võ Nguyên Giáp, Phường 12, Thành phố Vũng Tàu, Tỉnh Bà Rịa - Vũng Tàu, Việt Nam</p> 
                    </div>
                </div>
                <div class="col-6 position-relative">
                    <img class="position-absolute top-50 start-50 translate-middle" src="{{ asset('img/logo.png') }}" alt="">
                </div>
            </div>
            <div class="d-flex justify-content-around mt-5 p-3 bg-light rounded">
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.formnhap') }}" class="btn">nhập</a>
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.formxuat') }}" class="btn">xuất</a>
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.baocao.index') }}" class="btn">báo cáo</a>
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.khachhang.index') }}" class="btn">khách hàng</a>
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.thongke.index') }}" class="btn">Thống kê</a>
                <a style="background: #1c6e8c; color:#fcfbff" href="{{ route('trangchu.hanghoa.index') }}" class="btn">Hàng hóa</a>
            </div>       
        </div>
    </div>
    <div style="display:{{ $display ?? 'none' }}" id="popup" class="popup">
        <div class="popup_content">
        <button type="button" class="btn-close js-modal-close float-end"></button>
        <div class="popup-heading mt-3">
				<h2 class="text-center">{{ $popupTitle ?? '' }}</h2>
                @if ($errors->any())
                    <div class="row container">
                        <div class="alert alert-danger">Vui lòng kiểm tra lại dữ liệu!</div>
                    </div>
                @endif
                @if (session('msg'))
                    <div class="row container">
                        <div class="alert alert-{{ session('status') }}">{{ session('msg') }}</div>
                    </div>
                @endif
			</div>
            <div class="panel-body pt-3">
                <div class="container">
                    @include('form.'.$displayPopup)
                </div>
            </div>
        </div>
    </div>
    <script>
        const model = document.querySelector('.popup');
        const modalclose = document.querySelector('.js-modal-close');
        const modalcontener = document.querySelector('.popup_content')

        function closebuyticket() {
            model.style.display = 'none'
        }
        modalclose.addEventListener('click',closebuyticket)

        modalcontener.addEventListener('click', function (even) {
            even.stopPropagation()
        })

        model.addEventListener('click',closebuyticket)
    </script>
@endsection
