<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\nhap;
use App\Models\khachhang;
use App\Models\tonkho;
use App\Models\donvi;
use App\Models\hanghoa;
use App\Http\Requests\nhapRequest;

class nhapController extends Controller
{
    const _pageNumber = 5;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {            
        $allKhachHang = khachhang::select('maCongTy','tenCongty')->get();
        $allHang = nhap::select('tenhang')->groupBy('tenhang')->get();
        $allNhap = nhap::select('nhap.*','khachhang.tenCongty as tencongty')
        ->leftJoin('khachhang','nhap.idkhachhang','=','maCongTy');
      
        $filter = [];
        if(!empty($request->tenhang)){
            $tenhang = $request->tenhang;

            $filter[] = ['tenhang' ,'=',$tenhang];
        }
        if(!empty($request->tencongty)){
            $tencongty = $request->tencongty;

            $filter[] = ['idkhachhang' ,'=',$tencongty];
        }

        if(!empty($filter)){
            $allNhap = $allNhap->where($filter);     
        }

        $dateStart = null;
        $dateEnd = null;
        if(!empty($request->dateStart)){
            $dateStart = $request->dateStart;
        }
        if(!empty($request->dateEnd)){
            $dateEnd = $request->dateEnd;
        }

        if(!empty($dateStart)&&empty($dateEnd)){
            $allNhap = $allNhap->whereDate('nhap.created_at','=',$dateStart);
        }

        if(!empty($dateStart)&&!empty($dateEnd)){
            $allNhap = $allNhap->whereDate('nhap.created_at','>=',$dateStart)->whereDate('nhap.created_at','<=',$dateEnd);
        }


        //sort
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allNhap = $allNhap->orderBy('nhap.'.$sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allNhap = $allNhap->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allNhap = $allNhap->get();
        }

      
        $display = "block";
        $popupTitle = "Chi tiết phiếu nhập";
        $displayPopup = "showphieunhap";
        return view('trangchu', compact('allNhap','allKhachHang','allHang','display','displayPopup','popupTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $allDonVi = donvi::all();
        $allKhachHang = khachhang::all();
        $allHang = hanghoa::all();
        $display = "block";
        $popupTitle = "Thêm phiếu nhập";
        $displayPopup = "formnhap";
        return view('trangchu', compact('display','displayPopup','popupTitle','allKhachHang','allDonVi','allHang'));
    }
    public function addDonVi(Request $request)
    {
        $rule = [
                'tendonvi' => 'required|unique:donvi'
            ];
        $message = [
                'tendonvi.required' => 'Tên đơn vị không được để trống',
                'tendonvi.unique' => 'Tên đơn vị đã tồn tại',
            ];
        $request->validate($rule,$message);
        $allDonVi = new donvi;
        $allDonVi->tendonvi = $request->tendonvi;
        $allDonVi->save();
        return redirect()->back()->withInput();
    }
    public function addHangHoa(Request $request)
    {
        $rule = [
            'mahang'    => 'required|unique:hanghoa',
            'tenhang'   => 'required'
        ];
        $message = [
                'mahang.required' => 'Mã hàng không được để trống',
                'tenhang.required' => 'Tên hàng không được để trống',
                'mahang.unique' => 'Mã hàng đã tồn tại',
            ];
        $request->validate($rule,$message);

        $hanghoa = new hanghoa;
        $hanghoa->mahang = $request->mahang;
        $hanghoa->tenhang = $request->tenhang;
        $hanghoa->save();
        return redirect()->back()->withInput();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(nhapRequest $request)
    {
        $allHangHoa = hanghoa::where('tenhang',$request->tenhang);
        if($allHangHoa->count()<=0){
            return redirect()->back()->withInput()->with('msg','hàng chưa được thêm vào!')->with('status','danger');
        }
        $nhap = new nhap;
        $nhap->tenhang = $request->tenhang;
        $nhap->idkhachhang = $request->idkhachhang;
        $nhap->soxe = $request->soxe;
        $nhap->nhanvien = $request->nhanvien;
        $nhap->kho = $request->kho;
        $nhap->soluong = $request->soluong;
        $nhap->donvi = $request->donvi;
        $nhap->net = $request->net;
        $nhap->ghichu = $request->ghichu;
        $nhap->save();

        $tonkho = new tonkho;
        $tonkho->tenhang = $request->tenhang;
        $tonkho->idkhachhang = $request->idkhachhang;
        $tonkho->soluong = $request->soluong;
        $tonkho->kho = $request->kho;
        $tonkho->net = $request->net;
        $tonkho->save();

        return redirect()->route('trangchu.baocao.shownhap')->with('msg','Thêm thành công')->with('status','success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nhapdetail = nhap::find($id);
        $tenhangdetails = tonkho::select('*')
                ->where('idkhachhang',$nhapdetail->idkhachhang)
                ->where('tenhang',$nhapdetail->tenhang)
                ->where('kho',$nhapdetail->kho)
                ->where('soluong',$nhapdetail->soluong)
                ->get();
        $tenhangdetails = $tenhangdetails->first();
        if(!empty($tenhangdetails)){
            $tenhangdetails = $tenhangdetails->delete();
            $nhapdetail = $nhapdetail->delete();
        }
        else{
            return redirect()->back()->with('msg','xóa Thất bại do bạn đã xuất!')->with('status','danger');
        }
        if($nhapdetail){
            return redirect()->back()->with('msg','xóa thành công!')->with('status','success');
        }
        else{
            return redirect()->back()->with('msg','xóa Thất bại!')->with('status','danger');
        }
    }
}
