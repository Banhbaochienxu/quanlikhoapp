<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hanghoa;

class hangController extends Controller
{
    const _pageNumber = 5;
    public function index(Request $request){
        $allHangHoa = hanghoa::select('*');
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allHangHoa = $allHangHoa->orderBy($sortBy,$sortType);

        $keywords = null;
        if(!empty($request->keywords)){
            $keywords = $request->keywords;
        }
        if(!empty($keywords)){
            $allHangHoa = $allHangHoa->where(function($query) use($keywords){
                 $query->orWhere('mahang','like','%'.$keywords.'%');
                 $query->orWhere('tenhang','like','%'.$keywords.'%');
            });
        }

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allHangHoa = $allHangHoa->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allHangHoa = $allHangHoa->get();
        }

        $display = "block";
        $popupTitle = "Tất cả hàng hóa";
        $displayPopup = "showhanghoa";
        return view('trangchu', compact('allHangHoa','display','displayPopup','popupTitle'));
    }

    public function create(){
        $display = "block";
        $popupTitle = "Thêm hàng hóa";
        $displayPopup = "formhanghoa";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }

    public function store(Request $request){
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
        return redirect()->route('trangchu.hanghoa.gethanghoa');
    }
    public function edit(Request $request,string $id)
    {
        $hanghoaDetail = hanghoa::find($id);
        if(!empty($id) && !empty($hanghoaDetail)){
            $request->session()->put('id',$id);   
        }
        else{
            return redirect()->route('trangchu.hanghoa.showhanghoa')->with('msg','Hàng không tồn tại!')->with('status','danger');
        }
        $display = "block";
        $popupTitle = "Sửa hàng hóa";
        $displayPopup = "formEditHangHoa";
        return view('trangchu', compact('display','displayPopup','popupTitle','hanghoaDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        if(session('id')){
            $id = session('id');
            $rule = [
                'mahang'    => 'required|unique:hanghoa,mahang,'.$id,
                'tenhang'   => 'required'
            ];
            $message = [
                    'mahang.required' => 'Mã hàng không được để trống',
                    'tenhang.required' => 'Tên hàng không được để trống',
                    'mahang.unique' => 'Mã hàng đã tồn tại',
                ];
            $request->validate($rule,$message);
            $hanghoaDtail = hanghoa::find($id);
            $hanghoaDtail->mahang = $request->mahang;
            $hanghoaDtail->tenhang = $request->tenhang;
            $hanghoaDtail->save();

            return redirect()->route('trangchu.hanghoa.showhanghoa')->with('msg','Sửa thành công')->with('status','success');
        }
        else{
            return redirect()->route('trangchu.hanghoa.showhanghoa')->with('msg','Tài khoản không tồn tại')->with('status','danger');
        }
    }
    public function destroy(string $id){
        $hanghoaDetail = hanghoa::find($id);
        $hanghoaDetail = $hanghoaDetail->delete();
        return redirect()->route('trangchu.hanghoa.showhanghoa')->with('msg','Xóa thành công')->with('status','success');
    }
}
