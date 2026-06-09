# test-app-practice

## 概要

COACHTECH 教材 Tutorial 10-5「テスト ハンズオン演習」で作成した成果物です。

- ユーザー作成テストとメールアドレス重複テスト作成

## 使用技術

- PHP 8.x
- Laravel 10.x
- PHPUnit（テスト）
- Eloquent / Factory
- assertメソッド
- QueryExceptionスロー

## 学んだこと

- RefreshDatabase トレイト
- $this->を使ったassertメソッド実行方法
- actingAs()メソッドの使い方

## 動作確認

- sail artisan test --filter UserTest を実行
- テストが全てパスする（緑色のPASSが表示される）
- ユーザーがデータベースに保存されるテストがパス
- メールアドレス重複チェックのテストがパス
