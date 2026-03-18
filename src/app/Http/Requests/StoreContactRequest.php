<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                function ($attribute, $value, $fail) {
                    $nameParts = preg_split('/\s+/u', trim($value));

                    if (count($nameParts) < 2) {
                        $fail('お名前を正しく入力してください');
                        return;
                    }

                    foreach (array_slice($nameParts, 0, 2) as $namePart) {
                        if (mb_strlen($namePart) > 8) {
                            $fail('お名前は8文字以内で入力してください');
                            return;
                        }
                    }
                },
            ],
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'tel' => ['required', 'regex:/^\d{10,11}$/'],
            'gender' => 'required|in:1,2,3',
            'inquiry_type' => 'required|in:delivery,exchange,trouble,shop,other',
            'content' => 'required|string|max:120',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'お名前を入力してください',
            'name.string' => 'お名前を文字列で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'tel.required' => '電話番号を入力してください',
            'tel.regex' => '電話番号は正しい形式で入力してください',
            'gender.required' => '性別を選択してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}
