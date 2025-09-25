<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    /**
     * お問い合わせフォームの入力ページを表示
     */
    public function index()
    {
        $categories = Category::all();
        return view('contact.index', compact('categories'));
    }

    /**
     * 送信されたフォームデータを検証し、確認ページに渡す
     */
    public function confirm(ContactRequest $request)
    {
        $category = Category::find($request->category_id);
        
        $contact = $request->all();
        // tel_1, tel_2, tel_3の3つの値を結合して、telカラムとして保存
        $tel = $request->tel_1 . $request->tel_2 . $request->tel_3;
        $contact['tel'] = $tel;

        return view('contact.confirm', compact('contact', 'category'));
    }

    /**
     * データベースに保存するstoreメソッド
     */
    public function store(ContactRequest $request)
    {
        // // デバッグ
        // dd($request->all());
        
        // バリデーションされたデータを取得
        $validatedData = $request->validated();
        
        // 電話番号を結合
        $validatedData['tel'] = $validatedData['tel_1'] . $validatedData['tel_2'] . $validatedData['tel_3'];
        
        // 不要な個別電話番号フィールドを削除
        unset($validatedData['tel_1'], $validatedData['tel_2'], $validatedData['tel_3']);
        
        // データベースに保存
        Contact::create($validatedData);

        // thanksページにリダイレクト
        return redirect()->route('thanks');
    }

    /*完了ページを表示*/
    public function thanks()
    {
        return view('contact.thanks');
    }
}