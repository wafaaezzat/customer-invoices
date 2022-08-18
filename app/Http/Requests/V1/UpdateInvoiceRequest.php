<?php

namespace App\Http\Requests\V1;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user=$this->user();
        return $user!=null && $user->tokenCan('update');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $method=$this->method();
        if($method=='PUT'){
        return [
            'customerId'=>['required'],
            'amount'=>['required','email'],
            'status'=>['required'],
            'billedDate'=>['required'],
            'paidDate'=>['required'],
        
        ];
    }


    else{ //for patch the property is gonna be there sometimes (if the property is there then its going to be validated according to the required or the next rule)

        return [
            'customerId'=>['sometimes','required'],
            'amount'=>['sometimes','required','email'],
            'status'=>['sometimes','required'],
            'billedDate'=>['sometimes','required'],
            'paidDate'=>['sometimes','required'],
        
        ];
    }

    }

   


    protected function prepareForValidation(){
if($this->customerId){
        $this->merge([
            'customer_id'=>$this->customerId
    ]);
    }

    if($this->billedDate){
        $this->merge([
           
            'billed_date'=>$this->billedDate
           
    ]);
    }

    if($this->paidDate){
        $this->merge([
            'paid_date'=>$this->paidDate
    ]);
    }
}
}
