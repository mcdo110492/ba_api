<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AttributeSetRequest extends FormRequest
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
        $project_id = $this->input('project_id');
        $code = $this->input('code');
        
        return [
            'code' => ["required", "max:50", Rule::unique('attribute_set')->where(function ($query) use ($project_id, $code){
                return $query->where('project_id', $project_id)->where('code',$code);
            })],
            'project_id' => 'required|integer'
        ];
    }
}
