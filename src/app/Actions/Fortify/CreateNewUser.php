<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers; // まず、ルールブックをインポート
use Illuminate\Validation\Rules\Password;

class CreateNewUser implements CreatesNewUsers// 次に、ルールブックに従うことを宣言
{
    use PasswordValidationRules;

    /**
     * 新しいユーザーをデータベースに作成します。
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            // 👇 $this->passwordRules() を書き換える
            'password' => ['required', 'string', Password::min(8)],])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);
    }
}