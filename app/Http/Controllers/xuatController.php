<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\xuat;
use App\Models\khachhang;
use App\Models\tonkho;
use App\Models\nhap;
use App\Http\Requests\xuatRequest;


class xuatController extends Controller
{
    const _pageNumber = 5;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allKhachHang = khachhang::select('maCongTy','tenCongty')->get();
        $allHang = nhap::select('tenhang')->groupBy('tenhang')->get();
        $allXuat = xuat::select('*');

        $filter = [];
        if(!empty($request->tenhang)){
            $tenhang = $request->tenhang;

            $filter[] = ['tenhang' ,'=',$tenhang];
        }
        if(!empty($request->tencongty)){
            $tencongty = $request->tencongty;

            $filter[] = ['tenkhachhang' ,'=',$tencongty];
        }

        if(!empty($filter)){
            $allXuat = $allXuat->where($filter);     
        }

        //lọc ngày tháng
        $dateStart = null;
        $dateEnd = null;
        if(!empty($request->dateStart)){
            $dateStart = $request->dateStart;
        }
        if(!empty($request->dateEnd)){
            $dateEnd = $request->dateEnd;
        }

        if(!empty($dateStart)&&empty($dateEnd)){
            $allXuat = $allXuat->whereDate('created_at','=',$dateStart);
        }

        if(!empty($dateStart)&&!empty($dateEnd)){
            $allXuat = $allXuat->whereDate('created_at','>=',$dateStart)->whereDate('created_at','<=',$dateEnd);
        }

        //sort
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allXuat = $allXuat->orderBy($sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allXuat = $allXuat->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allXuat = $allXuat->get();
        }

        $display = "block";
        $displayPopup = "showphieuxuat";
        $popupTitle = "Chi tiết phiếu xuất";
        return view('trangchu', compact('display','displayPopup','popupTitle','allXuat','allKhachHang','allHang'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax()) {                     
            if(!empty($request->kho)){
                $output = '';
                $tenhangdetails = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
                ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
                ->where('tenCongty',$request->tencongty)
                ->where('tenhang',$request->tenhang)
                ->where('kho',$request->kho)
                ->get();
                
                $output .='<option selected disabled value="">--Ngày nhập--</option>';
                if ($tenhangdetails) {
                    $tenhangdetail = [];
                    foreach ($tenhangdetails as $item) {
                        if(in_array($item->created_at,$tenhangdetail)){
                            continue;
                        }
                        else{
                            array_push($tenhangdetail,$item->created_at);
                            $output .= '
                            <option value="'.$item->created_at.'">'.$item->created_at.' số lượng:'.$item->soluong.'</option>';
                        }
                    }
                }
                return Response($output);

                }
                if(!empty($request->tenhang)){
                    $output = '';
                    $tenhangdetails = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
                    ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
                    ->where('tenCongty',$request->tencongty)
                    ->where('tenhang',$request->tenhang)
                    ->get();
                    
                    $output .='<option selected disabled value="">--chọn kho--</option>';
                    if ($tenhangdetails) {
                        $tenhangdetail = [];
                        foreach ($tenhangdetails as $item) {
                            if(in_array($item->kho,$tenhangdetail)){
                                continue;
                            }
                            else{
                                array_push($tenhangdetail,$item->kho);
                                $output .= '
                                <option value="'.$item->kho.'">'.$item->kho.'</option>';
                            }
                        }
                    }
                    return Response($output);
        
                    }
            $output = '';
            $tenhangdetails = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
            ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
            ->where('tenCongty',$request->tencongty)
            ->get();
           
            $output .= '<option selected disabled value="">--chọn tên hàng--</option>';
            
            if ($tenhangdetails) {
                $tenhangdetail = [];
                foreach ($tenhangdetails as $item) {
                    if(in_array($item->tenhang,$tenhangdetail)){
                        continue;
                    }
                    else{
                        array_push($tenhangdetail,$item->tenhang);
                        $output .= '
                        <option value="'.$item->tenhang.'">'.$item->tenhang.'</option>';
                    }
                }
            }
            
            return Response($output);
        }
        $allTonKho = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
        ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
        ->get();
        $allKhachHang = khachhang::select('tenCongty')->get();
        $display = "block";
        $displayPopup = "formxuat";
        $popupTitle = "Thêm phiếu xuất";
        return view('trangchu', compact('display','displayPopup','popupTitle','allTonKho','allKhachHang'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(xuatRequest $request)
    {
        $tonkhoDetail = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
                ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
                ->where('tenCongty',$request->tencongty)
                ->where('tenhang',$request->tenhang)
                ->where('kho',$request->kho)
                ->where('tonkho.created_at',$request->ngaynhap)
                ->get();
        $tonkhoDetail = $tonkhoDetail->first();
        if($request->soluong > $tonkhoDetail->soluong){
            return redirect()->back()->with('msg','số lượng trong kho không đủ để xuất')->with('status','danger')->withInput();
        }
        $soluongton = $tonkhoDetail->soluong - $request->soluong;     
        if($soluongton>0){
            $tonkhoDetail->soluong = $soluongton;
            $tonkhoDetail->save();
        }else{
            $tonkhoDetail->delete();
        }
        $ngaynhap = $tonkhoDetail->created_at;
        $ngayluukho = $ngaynhap->diffInDays(date('Y-m-d H:i:s'))+1;
        $trongluong = $request->soluong * $tonkhoDetail->net;

        $xuat = new xuat;
        $xuat->tenhang = $request->tenhang;
        $xuat->tenkhachhang = $request->tencongty;
        $xuat->kho = $tonkhoDetail->kho;
        $xuat->soxe = $request->soxe;
        $xuat->nhanvien = $request->nhanvien;
        $xuat->soluong = $request->soluong;
        $xuat->dongia = $request->dongia;
        $xuat->net = $tonkhoDetail->net;
        $xuat->ngaynhap = $tonkhoDetail->created_at;
        $xuat->trongluong = $trongluong;
        $xuat->ngayluukho = $ngayluukho;
        $xuat->thanhtien = ($trongluong * $ngayluukho * $request->dongia);
        $xuat->save();



        return redirect()->route('trangchu.baocao.showxuat')->with('msg','Thêm thành công')->with('status','success');
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
        $xuatdetail = xuat::find($id);
        $tonkhoDetail = tonkho::select('tonkho.*','khachhang.tenCongty as tencongty')
                ->rightJoin('khachhang','tonkho.idkhachhang','=','maCongTy')
                ->where('tenCongty',$xuatdetail->tenkhachhang)
                ->where('tenhang',$xuatdetail->tenhang)
                ->where('kho',$xuatdetail->kho)
                ->where('tonkho.created_at',$xuatdetail->ngaynhap)
                ->get();
        $tonkhoDetail = $tonkhoDetail->first();
        if(!empty($tonkhoDetail)){
            $tonkhoDetail->soluong += $xuatdetail->soluong;
            $tonkhoDetail->save();
            $xuatdetail = $xuatdetail->delete();
        }
        else{
            return redirect()->back()->with('msg','xóa Thất bại!')->with('status','danger');
        }
        if($xuatdetail){
            return redirect()->back()->with('msg','xóa thành công!')->with('status','success');
        }
        else{
            return redirect()->back()->with('msg','xóa Thất bại!')->with('status','danger');
        }
    }
}
