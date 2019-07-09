<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeSetAttributesRequest extends FormRequest
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
        $set_id = $this->input('set_id');
        $attr_id = $this->input('attr_id');

        if($this->isMethod('put')){

            $id = $this->route('id');
           
            return [
                'attr_id' => ["required", "max:50", Rule::unique('attribute_set_attributes')->where(function ($query) use ($set_id, $attr_id, $id){
                    return $query->where('set_id', $set_id)->where('attr_id',$attr_id);
                })->ignore($id)],
                'set_id' => 'required|integer'
            ];
        }
        
        return [
            'attr_id' => ["required", "max:50", Rule::unique('attribute_set_attributes')->where(function ($query) use ($set_id, $attr_id){
                return $query->where('set_id', $set_id)->where('attr_id',$attr_id);
            })],
            'set_id' => 'required|integer'
        ];
    }
}
