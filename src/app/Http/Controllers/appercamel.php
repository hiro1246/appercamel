<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmContactRequest;
use App\Http\Requests\StoreContactRequest;
use Illuminate\Http\Request;
use App\Models\appercamel as AppercamelModel;

class appercamel extends Controller
{
    public function admin(Request $request)
    {
        $query = AppercamelModel::orderByDesc('id');

        if ($name = $request->input('name')) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email = $request->input('email')) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        $gender = $request->input('gender');
        if ($gender && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        if ($inquiryType = $request->input('inquiry_type')) {
            $query->where('inquiry_type', $inquiryType);
        }

        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
        }

        $contacts = $query->paginate(7)->appends($request->query());

        return view('admin', compact('contacts'));
    }

    public function export(Request $request)
    {
        $query = AppercamelModel::orderByDesc('id');

        if ($name = $request->input('name')) {
            $query->where('name', 'like', '%' . $name . '%');
        }

        if ($email = $request->input('email')) {
            $query->where('email', 'like', '%' . $email . '%');
        }

        $gender = $request->input('gender');
        if ($gender && $gender !== 'all') {
            $query->where('gender', $gender);
        }

        if ($inquiryType = $request->input('inquiry_type')) {
            $query->where('inquiry_type', $inquiryType);
        }

        if ($date = $request->input('date')) {
            $query->whereDate('created_at', $date);
        }

        $contacts = $query->get();

        $genderMap = ['1' => '男性', '2' => '女性', '3' => 'その他'];
        $inquiryMap = [
            'delivery' => '商品のお届けについて',
            'exchange' => '商品の交換について',
            'trouble'  => '商品トラブル',
            'shop'     => 'ショップへのお問い合わせ',
            'other'    => 'その他',
        ];

        $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($contacts, $genderMap, $inquiryMap) {
            $handle = fopen('php://output', 'w');
            // UTF-8 BOM（Excelでの文字化け防止）
            fwrite($handle, "\xEF\xBB\xBF");

            fputcsv($handle, ['ID', 'お名前', '性別', 'メールアドレス', '電話番号', '住所', '建物名', 'お問い合わせ種別', 'お問い合わせ内容', '登録日時']);

            foreach ($contacts as $contact) {
                fputcsv($handle, [
                    $contact->id,
                    $contact->name,
                    $genderMap[$contact->gender] ?? $contact->gender,
                    $contact->email,
                    $contact->tel,
                    $contact->address ?? '',
                    $contact->building ?? '',
                    $inquiryMap[$contact->inquiry_type] ?? $contact->inquiry_type,
                    $contact->content ?? '',
                    $contact->created_at?->format('Y-m-d H:i:s') ?? '',
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function index()
    {
        return view('index');
    }
    public function confirm(ConfirmContactRequest $request)
    {
        $validated = $request->validated();

        $contact = [
            'name' => $validated['name_last'] . ' ' . $validated['name_first'],
            'email' => $validated['email'],
            'address' => $validated['address'],
            'building' => $validated['building'] ?? null,
            'tel' => $validated['tel1'] . $validated['tel2'] . $validated['tel3'],
            'gender' => $validated['gender'],
            'inquiry_type' => $validated['inquiry_type'],
            'content' => $validated['content'],
        ];

        return view('confirm', compact('contact'));
    }
    public function edit(Request $request)
    {
        // 結合されたデータを分割してセッションに保存
        $data = $request->all();

        // nameを分割（スペースで分割）
        if (isset($data['name'])) {
            $nameParts = explode(' ', $data['name'], 2);
            $data['name_last'] = $nameParts[0] ?? '';
            $data['name_first'] = $nameParts[1] ?? '';
            unset($data['name']);
        }

        // telを分割（3桁-4桁-4桁）
        if (isset($data['tel'])) {
            $tel = $data['tel'];
            $data['tel1'] = substr($tel, 0, 3);
            $data['tel2'] = substr($tel, 3, 4);
            $data['tel3'] = substr($tel, 7, 4);
            unset($data['tel']);
        }

        // CSRFトークンを削除
        unset($data['_token']);

        // セッションにフラッシュデータとして保存
        $request->session()->flash('old_input', $data);
        return redirect('/');
    }
    public function store(StoreContactRequest $request)
    {
        $validated = $request->validated();
        AppercamelModel::create($validated);
        return view('thanks');
    }
}
