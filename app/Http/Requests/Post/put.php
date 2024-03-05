<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class put extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation()
    {
        if (str($this->slug)->trim() == "")
            $this->merge([
                'slug' => str($this->title)->slug()

            ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $postId = $this->route("post") ? $this->route("post")->id : null;
        return [
            "title" => "required|min:5|max:255",
            "slug" => "required|min:5|max:255|unique:posts,slug," . $postId,
            "date" => "required",
            "description" => "required",
            "text" => "required",
            "posted" => "required",
            "type" => "required",
            "category_id" => "required"
        ];
    }
}
 