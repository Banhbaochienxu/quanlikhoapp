<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class khachhangRequest extends FormRequest
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
        if(session('id')){
            $id = session('id');  
            return [
                'macongty'      => 'unique:khachhang,maCongTy,'.$id,
                'tencongty'     => 'required',
                'sothue'        => 'required|numeric|min:1000000000',
                'diachi'        => 'required',
                'sdt'           => 'required|regex:/(0)[0-9]{9}/'
            ];        
        }
        return [
            'tencongty'     => 'required',
            'sothue'        => 'required|numeric|min:1000000000',
            'diachi'        => 'required',
            'sdt'           => 'required|regex:/(0)[0-9]{9}/'
        ];
    }

    public function messages(): array
    {
        if(session('id')){
            $add = "";
        }
        return [
            'required'      => ':attribute không được để trống',
            'numeric'       => ':attribute phải là số',
            'min'           => ':attribute phải hơn 10 số',
            'max'           => ':attribute không được hơn 20 số',
            'regex'         => ':attribute không đúng định dạng',
            'unique'        => ':attribute đã tồn tại'
        ];
    }

    public function attributes(): array
    {
        return [
            'tencongty'     => 'Tên công ty',
            'sothue'        => 'Số thuế',
            'diachi'        => 'Địa chỉ',
            'sdt'           => 'Số điện thoại',
            'macongty'      => 'Mã công ty'
        ];
    }
}
