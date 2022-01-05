<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'question' => 'required|min:3',
            'image' => 'nullable|image|max:2148|mimes:jpg,png,jpeg',
            'answer1' => 'required',
            'answer2' => 'required',
            'answer3' => 'required',
            'answer4' => 'required',
            'correct_answer' => 'required',
        ];
    }


    public function attributes(){
        return [
            'question' => 'Soru',
            'image' => 'Soru Fotoğrafı',
            'answer1' => '1.Cevap',
            'answer2' => '2.Cevap',
            'answer3' => '3.Cevap',
            'answer4' => '4.Cevap',
            'correct_answer' => 'Doğru Cevap',
        ];
    }
}
