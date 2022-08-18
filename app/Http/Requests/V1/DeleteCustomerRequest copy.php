<?php

namespace App\Http\Requests\V1;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;

class DeleteCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user=$this->user();
        return $user!=null && $user->role!=1;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
           
            'name'=>['required'],
            'type'=>['required',Rule::in(['I','B','i','b'])],
            'email'=>['required','email'],
            'address'=>['required'],
            'city'=>['required'],
            'state'=>['required'],
            'postalCode'=>['required'],
        ];
    }
    public function withValidator(Validator $validator)
    {
        if ($validator->fails()) {
            abort(response()->json([
                'errors' => $validator->errors()], 402));
        }
    }
}
