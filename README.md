# my-memo-app
 メモアプリを共同開発で作成しました。<br>
 カテゴリ別にメモを登録することができます。
 レスポンシブ対応しているのでスマホからもご確認いただけます。
![memo-screernshot](https://github.com/Miyajima0828/memo-application/assets/104330386/8460b98d-738e-4521-9ab0-0e941adbbff0)
![Screenshot_20231224-173247](https://github.com/Miyajima0828/memo-application/assets/104330386/7e0dfe14-304a-430f-931d-a9f1b1f4340d)
![Screenshot_20231224-173321](https://github.com/Miyajima0828/memo-application/assets/104330386/31893b05-e7f2-4c2c-bf88-5dd6c6b40a52)


# 使い方
 1.画面左側のメインカテゴリの＋ボタン（スマホ等の場合はハンバーガーメニューを開いてからメインカテゴリの＋ボタン）をクリック<br>
 2.メインとサブのカテゴリの登録<br>
 3.表示されたタブの下にメモを入力。<br>
 4.フォーカスアウトされたときにデータベースの登録が行われます。 <br>
 5.カテゴリの登録はメインカテゴリ5個、サブカテゴリ5個の計25個のメモが、半角だと10000字、全角だと5000字まで登録ができます。<br>
 6.カテゴリの名前の編集や削除は矢印アイコンとゴミ箱アイコンでそれぞれできます。


# URL
https://my-memo-app.net/<br>
初めて利用される方は画面中部のサインインからお名前、メールアドレス、パスワードを設定してください。


# 使用技術
- PHP 8.2.11
- Laravel Framework 10.30.1
- MySQL 5.7
- Apche
- Composer version 2.6.6
- Jetstream 4.0
  - Livewire 3.0
- Node v21.1.0
- npm 10.2.0


# 機能一覧
- ユーザー登録、ログイン機能(Jetstream)
- 検索機能(Livewire)
- メインカテゴリ追加(Livewire)
- メインカテゴリの削除(Livewire)
- サブカテゴリの追加(Livewire)
- サブカテゴリの削除(Livewire)
- フォーカスアウト時のデータベースの登録(Livewire)
