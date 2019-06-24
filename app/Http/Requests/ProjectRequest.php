<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        if(request()->isMethod('put')){

            return [
                'code' => "required|unique:projects,code|max:50,$this->id",
                'project' => 'required|max:250'
            ];
        }
        
        return [
            'code' => 'required|unique:projects,code|max:50',
            'project' => 'required|max:250'
        ];
    }
}
