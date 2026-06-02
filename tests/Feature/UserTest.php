<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class UserTest extends TestCase
{
    // 💡 テスト実行ごとにデータベースをまっさらにリセットする設定
    use RefreshDatabase;

    /**
     * テスト1: ユーザー作成テスト（正常系）
     */
    public function test_user_can_be_created_successfully(): void
    {
        // 1. ファクトリでユーザーを1人作成（DBに保存）
        $user = User::factory()->create([
            'name' => '山田 太郎',
            'email' => 'yamada@example.com',
        ]);

        // 2. データベースに指定したデータが存在するか検証
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => '山田 太郎',
            'email' => 'yamada@example.com',
        ]);
    }

    /**
     * テスト2: メールアドレス重複テスト（異常系）
     */
    public function test_user_cannot_be_created_with_duplicate_email(): void
    {
        $sharedEmail = 'duplicate@example.com';

        // 1. まず1人目のユーザーを共通のメールアドレスで作成
        User::factory()->create([
            'email' => $sharedEmail,
        ]);

        // 2. データベースの「一意性制約（Unique）違反」のエラーが起きることを”事前に”期待する
        $this->expectException(QueryException::class);

        // 3. 2人目のユーザーを全く同じメールアドレスで作成しようとする（ここでエラーが発生し、テスト成功となる）
        User::factory()->create([
            'email' => $sharedEmail,
        ]);
    }
}