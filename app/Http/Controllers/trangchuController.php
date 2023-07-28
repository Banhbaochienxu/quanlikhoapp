<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tonkho;
use App\Models\xuat;
use App\Models\nhap;
use App\Models\khachhang;

class trangchuController extends Controller
{
    const _pageNumber = 5;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $displayPopup = 'formnhap';
        return view('trangchu',compact('displayPopup'));
    }
    public function showBaoCao()
    {
        $display = "block";
        $displayPopup = "formbaocao";
        $popupTitle = "Báo Cáo";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }

    public function showTonKho(Request $request)
    {
        $allKhachHang = khachhang::select('maCongTy','tenCongty')->get();
        $allHang = nhap::select('tenhang')->groupBy('tenhang')->get();
        $allTonKho = tonkho::select('*');

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
            $allTonKho = $allTonKho->where($filter);     
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
            $allTonKho = $allTonKho->whereDate('created_at','=',$dateStart);
        }

        if(!empty($dateStart)&&!empty($dateEnd)){
            $allTonKho = $allTonKho->whereDate('created_at','>=',$dateStart)->whereDate('created_at','<=',$dateEnd);
        }

        //sort
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allTonKho = $allTonKho->orderBy($sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allTonKho = $allTonKho->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allTonKho = $allTonKho->get();
        }

        $display = "block";
        $popupTitle = "Hàng còn trong kho";
        $displayPopup = "showtonkho";
        return view('trangchu', compact('allTonKho','display','displayPopup','popupTitle','allKhachHang','allHang'));
    }

    public function showHoaDon(Request $request)
    {
        $allKhachHang = khachhang::select('maCongTy','tenCongty')->get();
        $allHang = nhap::select('tenhang')->groupBy('tenhang')->get();
        $allHoaDon = xuat::select('*');

        $filter = [];
        if(!empty($request->tenhang)){
            $tenhang = $request->tenhang;

            $filter[] = ['tenhang' ,'=',$tenhang];
        }
        if(!empty($request->tencongty)){
            $tencongty = $request->tencongty;

            $filter[] = ['tenkhachhang' ,'=',$tencongty];
        }
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        if(!empty($filter)){
            $allHoaDon = $allHoaDon->where($filter);     
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
            $allHoaDon = $allHoaDon->whereDate('created_at','=',$dateStart);
        }

        if(!empty($dateStart)&&!empty($dateEnd)){
            $allHoaDon = $allHoaDon->whereDate('created_at','>=',$dateStart)->whereDate('created_at','<=',$dateEnd);
        }

        //sort
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allHoaDon = $allHoaDon->orderBy($sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allHoaDon = $allHoaDon->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allHoaDon = $allHoaDon->get();
        }

        $display = "block";
        $popupTitle = "Hóa đơn";
        $displayPopup = "showhoadon";
        return view('trangchu', compact('allHoaDon','display','displayPopup','popupTitle','allHang','allKhachHang'));
    }


    public function khachhang()
    {
        $display = "block";
        $popupTitle = "Khách hàng";
        $displayPopup = "khachhang";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }
    public function thongke()
    {
        $display = "block";
        $popupTitle = "Thống kê";
        $displayPopup = "showthongke";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }

    public function thongkehang(Request $request)
    {

        $allKhachHang = khachhang::select('maCongTy','tenCongty')->get();
        $allHang = nhap::select('tenhang')->groupBy('tenhang')->get();
        $allTongHang = tonkho::selectRaw('SUM(soluong) AS soluong')->get();
        $allTonKho = tonkho::select('tenhang','idkhachhang')
        ->selectRaw('SUM(soluong) AS soluong')
        ->groupBy('tenhang','idkhachhang');

        
        $filter = [];
        if(!empty($request->tenhang)){
            $tenhang = $request->tenhang;

            $filter[] = ['tenhang' ,'=',$tenhang];
        }
        if(!empty($request->tencongty)){
            $tencongty = $request->tencongty;

            $filter[] = ['idkhachhang' ,'=',$tencongty];
        }
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }

        $keywords = null;
        if(!empty($filter)){
            $allTonKho = $allTonKho->where($filter);     
        }
        if(!empty($keywords)){
            $allTonKho = $allTonKho->where(function($query) use($keywords){
                 $query->orWhere('tenhang','like','%'.$keywords.'%');
                 $query->orWhere('idkhachhang','like','%'.$keywords.'%');
            });
        }

        //sort
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allTonKho = $allTonKho->orderBy($sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allTonKho = $allTonKho->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allTonKho = $allTonKho->get();
        }

        $display = "block";
        $popupTitle = "Thống kê hàng";
        $displayPopup = "thongkehang";
        return view('trangchu', compact('allTonKho','display','displayPopup','popupTitle','allKhachHang','allHang','allTongHang'));
    }

    public function hanghoa()
    {
        $display = "block";
        $popupTitle = "Hàng hóa";
        $displayPopup = "hanghoa";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
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
        //
    }
}
