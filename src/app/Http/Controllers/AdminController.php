<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        // 検索キーワードの取得
        $nameEmailKeyword = $request->input('name_email');
        $gender = $request->input('gender');
        $categoryId = $request->input('category_id');
        $date = $request->input('date');

        // クエリビルダーを操作してDBからデータを取得
        $query = Contact::query();

        // 名前・メールアドレスの検索
        if ($nameEmailKeyword) {
            // 複数のOR条件をANDで結合するために、クロージャ?（無名関数）を使用
            $query->where(function ($q) use ($nameEmailKeyword) {
                // 姓での部分一致検索
                $q->where('last_name', 'like', '%' . $nameEmailKeyword . '%');
                // 名での部分一致検索
                $q->orWhere('first_name', 'like', '%' . $nameEmailKeyword . '%');
                // 姓と名を結合したフルネームでの部分一致検索
                $q->orWhereRaw("CONCAT(last_name, first_name) LIKE ?", ['%' . $nameEmailKeyword . '%']);
                // メールアドレスでの部分一致検索
                $q->orWhere('email', 'like', '%' . $nameEmailKeyword . '%');
            });
        }

        // 性別の絞り込み
        if ($gender) {
            $query->where('gender', $gender);
        }

        // お問い合わせ種類の絞り込み
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        // 日付の絞り込み
        if ($date) {
            $query->whereDate('created_at', $date);
        }

        // データベースから全てデータを持ってくる
        // ページネーションを適用
        $contacts = $query->paginate(7);//ここでクエリからデータを取得している
        $categories = Category::all();

        return view('admin.index', compact('contacts', 'categories'));
    }

    public function destroy($id)
    {
    $contact = Contact::find($id);
    if ($contact) {
        $contact->delete();
        return redirect()->route('admin.index')->with('success', 'お問い合わせを削除しました。');
    }
    return redirect()->route('admin.index')->with('error', 'お問い合わせが見つかりませんでした。');
    }
}


