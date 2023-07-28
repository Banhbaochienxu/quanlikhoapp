<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\userRequest;


class userController extends Controller
{
    const _pageNumber = 5;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->level !=2){
            return redirect()->back();
        }
        $allUser = User::select('*');
        $sortBy = 'created_at';
        $sortType = 'DESC';
        $allUser = $allUser->orderBy($sortBy,$sortType);

        //phân trang
        if(!empty(self::_pageNumber)){
        
        $allUser = $allUser->paginate(self::_pageNumber)
        //với kết quả tìm kiếm 
        ->withQueryString();
        }else{
            $allUser = $allUser->get();
        }

        $display = "block";
        $popupTitle = "Quản lý tài khoản";
        $displayPopup = "showUser";
        return view('trangchu', compact('allUser','display','displayPopup','popupTitle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->level !=2){
            return redirect()->back();
        }
        $display = "block";
        $popupTitle = "Thêm tài khoản";
        $displayPopup = "formAddUser";
        return view('trangchu', compact('display','displayPopup','popupTitle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(userRequest $request)
    {
        if(Auth::user()->level !=2){
            return redirect()->back();
        }
        $user = new user;
        $user->name = $request->name;
        $user->password = bcrypt($request->pwd);
        $user->email = $request->email;
        $user->level = $request->level;
        $user->save();
        
        return redirect()->route('trangchu.quanlytaikhoan.index')->with('msg','Thêm tài khoản thành công')->with('status','success');
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
    public function edit(string $id, Request $request)
    {
        if(Auth::user()->level !=2 && Auth::user()->id != $id){
            return redirect()->back();
        }
        $userDetail = user::find($id);
        if(!empty($id) && !empty($userDetail)){
            $request->session()->put('id',$id);   
            $editStatus = true;
        }
        else{
            return redirect()->route('trangchu.quanlytaikhoan.index')->with('msg','Tài khoản không tồn tại!')->with('status','danger');
        }

        $display = "block";
        $popupTitle = "Sửa tài khoản";
        $displayPopup = "formEditUser";
        return view('trangchu', compact('display','displayPopup','popupTitle','userDetail'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(userRequest $request)
    {
        if(session('id')){
            $id = session('id');
            $userDtail = user::find($id);
            $userDtail->name = $request->name;
            $userDtail->email = $request->email;
            if($userDtail->password != $request->pwd){
                $userDtail->password = bcrypt($request->pwd);
            }
            $userDtail->level = $request->level;
            $userDtail->save();

            return redirect()->route('trangchu.quanlytaikhoan.index')->with('msg','Cập nhập tài khoản thành công')->with('status','success');
        }
        else{
            return redirect()->route('trangchu.quanlytaikhoan.index')->with('msg','Tài khoản không tồn tại')->with('status','danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(Auth::user()->level !=2 || $id == 1){
            return redirect()->back();
        }
        $userDetail = user::find($id);
        $userDetail = $userDetail->delete();
        if($userDetail){
            return redirect()->back()->with('msg','xóa tài khoản thành công!')->with('status','success');
        }
        else{
            return redirect()->back()->with('msg','xóa tài Thất bại!')->with('status','danger');
        }
    }
}
