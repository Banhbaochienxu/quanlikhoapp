<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class nhapRequest extends FormRequest
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
            'tenhang'           => 'required',
            'idkhachhang'       => 'required',
            'soxe'              => 'required',
            'nhanvien'          => 'required',
            'kho'               => 'required',
            'soluong'           => 'required',
            'net'               => 'required'
        ];
    }

    public function messages(): array
    {
        return [
            'required'      => ':attribute không được để trống'
        ];
    }

    public function attributes(): array
    {
        return [
            'tenhang'       => 'Tên hàng',
            'idkhachhang'   => 'Tên khách hàng',
            'soxe'          => 'số xe',
            'nhanvien'      => 'Nhân viên',
            'kho'           => 'Kho',
            'soluong'       => 'Số lượng',
            'net'           => 'Net'
        ];
    }
}
