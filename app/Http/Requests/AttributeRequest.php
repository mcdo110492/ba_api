<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttributeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = auth()->user();
        if($user->role === 'admin'){
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->isMethod('put')){

            $id = $this->route('id');
           
            return [
                'attribute' => "required|unique:attributes,attribute,$id|max:50",
                'is_native' => 'required|boolean'
            ];
        }
        
        return [
            'attribute' => "required|unique:attributes,attribute|max:50",
            'is_native' => 'required|boolean'
        ];
    }
}
