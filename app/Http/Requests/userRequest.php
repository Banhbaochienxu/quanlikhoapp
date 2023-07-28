<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $pwd = '|max:32';
        $email = 'unique:users,email';
        if(session('id')){
            $id = session('id');
            $email .= ','.$id;
            $pwd = '';
        }
        return [
            'name'         => 'required',
            'email'        => 'required|email|'.$email,
            'pwd'          => 'required|min:3'.$pwd,
            'level'        => 'required',
            'pwd2'         => 'required|same:pwd'
        ];
    }
    public function messages(): array
    {
        return [
            'required'         => ':attribute không được để trống ',
            'min'              => ':attribute phải có ít nhất 3 kí tự',
            'unique'              => ':attribute đã tồn tại',
            'same'             =>'Mật khẩu không khớp'
        ];
    }
    public function attributes(): array
    {
        return [
            'name'         => 'Tên tài khoản',
            'email'        => 'email',
            'pwd'          => 'Mật khẩu',
            'level'        => 'Quyền',
            'pwd2'         => 'Xác nhận mật khẩu'
        ];
    }
}
