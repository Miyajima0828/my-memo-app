# my-memo-app
 メモアプリを共同開発で作成しました。<br>
 カテゴリ別にメモを登録することができます。
 レスポンシブ対応しているのでスマホからもご確認いただけます。
![memo-screernshot](https://github.com/Miyajima0828/memo-application/assets/104330386/8460b98d-738e-4521-9ab0-0e941adbbff0)
![Screenshot_20231224-173247](https://github.com/Miyajima0828/memo-application/assets/104330386/acd396ea-94d8-450d-95b8-f93e9cda1fb3)
![Screenshot_20231224-173321](https://github.com/Miyajima0828/memo-application/assets/104330386/1bf7a747-f69a-4acd-b2c4-f710835bcd7e)

# 使い方
 1.画面左側のメインカテゴリの＋ボタン（スマホ等の場合はハンバーガーメニューを開いてからメインカテゴリの＋ボタン）をクリックしてください。<br>
 2.メインとサブのカテゴリの登録を行ってください。<br>
 3.表示されたタブの下にメモを入力してください。<br>
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
- Apache 2.4.54
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
