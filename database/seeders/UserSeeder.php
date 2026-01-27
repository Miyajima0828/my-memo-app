<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // テスト用の固定ユーザーを作成
        // メールアドレス: test@example.com
        // パスワード: password
        User::create([
            'name' => 'テストユーザー',
            'email' => 'test@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // 開発用の追加ユーザー
        User::create([
            'name' => '山田太郎',
            'email' => 'yamada@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => '佐藤花子',
            'email' => 'sato@example.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // ランダムなユーザーを10人作成
        User::factory()->count(10)->create();
    }
}
