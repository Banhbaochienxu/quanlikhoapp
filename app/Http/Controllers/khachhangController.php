<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\khachhang;
use App\Http\Requests\khachhangRequest;

class khachhangController extends Controller
{
    const _pageNumber = 5;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $allKhachHang = khachhang::select('*');
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allKhachHang = $allKhachHang->orderBy($sortBy,$sortType);

        $keywords = null;
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        if(!empty($keywords)){
            $allKhachHang = $allKhachHang->where(function($query) use($keywords){
                 $query->orWhere('tenCongty','like','%'.$keywords.'%');
                 $query->orWhere('maCongTy','like','%'.$keywords.'%');
                 $query->orWhere('soThue','like','%'.$keywords.'%');
            });
        }

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allKhachHang = $allKhachHang->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allKhachHang = $allKhachHang->get();
        }
        $display = "block";
        $popupTitle = "Thông tin khách hàng";
        $displayPopup = "showkhachhang";
        return view('trangchu', compact('allKhachHang','display','displayPopup','popupTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $display = "block";
        $popupTitle = "Thêm khách hàng";
        $displayPopup = "formkhachhang";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(khachhangRequest $request)
    {
        $arrtencongty = explode(' ', $request->tencongty);
        $macongty="";

        foreach($arrtencongty as $item){
            $macongty.=substr($item,0,1);
        }

        $macongty .=substr($request->sothue,-3);
        // $macongty = substr($request->tencongty,0,1);

        $khachhang = new khachhang;
        $khachhang->maCongTy = $macongty;
        $khachhang->tenCongty = $request->tencongty;
        $khachhang->soThue = $request->sothue;
        $khachhang->diaChi = $request->diachi;
        $khachhang->sdt = $request->sdt;
        $khachhang->save();

        return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Thêm thành công')->with('status','success');

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
    public function edit(Request $request,string $id)
    {
        $khachhangDetail = khachhang::find($id);
        if(!empty($id) && !empty($khachhangDetail)){
            $request->session()->put('id',$id);   
            $editStatus = true;
        }
        else{
            return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Khách hàng không tồn tại!')->with('status','danger');
        }
        $display = "block";
        $popupTitle = "Sửa khách hàng";
        $displayPopup = "formEditKhachHang";
        return view('trangchu', compact('display','displayPopup','popupTitle','khachhangDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(khachhangRequest $request)
    {
        if(session('id')){
            $id = session('id');
            $khachhangDtail = khachhang::find($id);
            $khachhangDtail->tenCongty = $request->tencongty;
            $khachhangDtail->maCongTy = $request->macongty;
            $khachhangDtail->diaChi = $request->diachi;
            $khachhangDtail->soThue = $request->sothue;
            $khachhangDtail->sdt = $request->sdt;
            $khachhangDtail->save();

            return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Sửa thành công')->with('status','success');
        }
        else{
            return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Tài khoản không tồn tại')->with('status','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $khachhangDetail = khachhang::find($id);
            $khachhangDetail = $khachhangDetail->delete();
            return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Xóa thành công')->with('status','success');
          }
          catch (\Exception $e) {
            return redirect()->route('trangchu.khachhang.showkhachhang')->with('msg','Khách hàng còn hàng trong kho')->with('status','danger');
          }
    }
}
