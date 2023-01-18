<?php

namespace App\Http\Requests\Post;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRequest extends FormRequest
{
    public function attributes()
    {
        return [
          'title'=>'This field is required',
          'short_content'=>'This field is required',
          'content'=>'This field is required',
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
//        return Gate::authorize('create-post', Role::find(2));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title'=>'required|max:255',
            'short_content'=>'required|max:255',
            'content'=>'nullable',
            'image'=>'nullable|image|max:2048'
        ];
    }
}
