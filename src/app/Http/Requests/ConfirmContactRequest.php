<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConfirmContactRequest extends FormRequest
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
            'name_last' => 'required|string|max:8',
            'name_first' => 'required|string|max:8',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:255',
            'building' => 'nullable|string|max:255',
            'tel1' => ['required', 'digits:3', 'regex:/^[0-9]{3}$/'],
            'tel2' => ['required', 'digits:4', 'regex:/^[0-9]{4}$/'],
            'tel3' => ['required', 'digits:4', 'regex:/^[0-9]{4}$/'],
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
            'name_last.required' => '姓を入力してください',
            'name_last.string' => '姓を文字列で入力してください',
            'name_last.max' => '姓は8文字以内で入力してください',
            'name_first.required' => '名を入力してください',
            'name_first.string' => '名を文字列で入力してください',
            'name_first.max' => '名は8文字以内で入力してください',
            'email.required' => 'メールアドレスを入力してください',
            'email.email' => 'メールアドレスはメール形式で入力してください',
            'address.required' => '住所を入力してください',
            'tel1.required' => '電話番号を入力してください',
            'tel1.digits' => '電話番号は5桁まで入力してください',
            'tel1.regex' => '半角英数字で入力してください',
            'tel2.required' => '電話番号を入力してください',
            'tel2.digits' => '電話番号は5桁まで入力してください',
            'tel2.regex' => '半角英数字で入力してください',
            'tel3.required' => '電話番号を入力してください',
            'tel3.digits' => '電話番号は5桁まで入力してください',
            'tel3.regex' => '半角英数字で入力してください',
            'gender.required' => '性別を選択してください',
            'inquiry_type.required' => 'お問い合わせの種類を選択してください',
            'content.required' => 'お問い合わせ内容を入力してください',
            'content.max' => 'お問い合わせ内容は120文字以内で入力してください',
        ];
    }
}