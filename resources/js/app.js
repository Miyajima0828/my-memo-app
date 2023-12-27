import './bootstrap';

// ハンバーガーメニューに関するコード
document.getElementById('button').addEventListener('click', event => {
  bars.classList.toggle('hidden')
  menu.classList.toggle('translate-x-full')
});

// ctrlキーとSキーの同時押しでhtml保存のダイアログを表示させないようにする
document.addEventListener('keydown', function (event) {
  if (event.ctrlKey && event.key === 's') {
    event.preventDefault();
    return false;
  }
});

// 保存時のための表示
const textarea = document.getElementById('myTextarea');
let cnt = 0;

textarea.addEventListener('input', function (event) {

  if (cnt === 0) {
    document.getElementById('saveAreaLg').classList.toggle('hidden')
    document.getElementById('saveArea').classList.toggle('hidden')
    cnt++;

  }
});