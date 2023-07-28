<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class xuatRequest extends FormRequest
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
        return [
            'tencongty'         => 'required',
            'tenhang'           => 'required',
            'kho'               => 'required',
            'ngaynhap'          => 'required',
            'soxe'              => 'required',
            'nhanvien'          => 'required',           
            'soluong'           => 'required|numeric|gt:0',
            'dongia'            => 'required|numeric|gt:0'
        ];
    }
    public function messages(): array
    {
        return [
            'required'      => ':attribute không được để trống',
            'numeric'       => ':attribute phải là số',
            'gt'          => ':attribute phải lớn hơn 0'
        ];
    }
    public function attributes(): array
    {
        return [
            'tencongty'     => 'Tên công ty',
            'kho'           => 'Kho',
            'ngaynhap'      => 'Ngày nhập',
            'tenhang'       => 'Hàng xuất',
            'soxe'          => 'số xe',
            'soluong'       => 'Số lượng',
            'dongia'        => 'Đơn giá',
            'nhanvien'      => 'Nhân viên'
        ];
    }
}
