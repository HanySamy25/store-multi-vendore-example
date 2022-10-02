<?php

namespace App\Http\Requests;

use App\Models\Category;
use App\Rules\Filter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // this depend on user rules
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        // Category::rules(); we can get from model
        // $id=$this->input('category');// from body  not vaild;
        $id=$this->route('id');//from parameter
        //dd($this);
        return [
            'name'=>['required','string','min:4','max:10',
            // function ($attribute,$value,$fails) // custom function
            // {
            //     if(strtolower($value) == 'laravel'){
            //         $fails('This Name Is Forbidden');
            //     }
            // },
            // new Filter(['php','laravel','js']),
            'filter:php,laravel,js',
            // 'Unique:categories,name,$id'
            Rule::unique('categories','name')->ignore($id)// id for update
            ],
            'parent_id'=>['nullable','int','exists:categories,id'],
            'image'=>['image','max:1048576'],//,'dimensions:width=1000,height=1000'
            'status'=>'in:active,inactive'
        ];
    }


    public function messages()
    {
        return [
            'name.unique'=>'this field (:attribute) is already exist'
        ];
    }

}
