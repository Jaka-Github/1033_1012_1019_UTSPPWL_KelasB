<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UpdateBookRequest extends FormRequest
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
     * @return array<string,\Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:250', 
            'author'      => 'required|string|max:150', 
            'publisher'   => 'required|string|max:150', 
            'year'        => 'required|integer|min:1900|max:' . date('Y'), 
            'stock'       => 'required|integer|min:0' 
        ];
    }
}
