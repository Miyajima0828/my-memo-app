import './bootstrap';

// ハンバーガーメニューに関するコード
document.getElementById('button').addEventListener('click', event => {
  bars.classList.toggle('hidden')
  menu.classList.toggle('translate-x-full')
});

// ctrlキーとSキーの同時押しでhtml保存のダイアログを表示させないようにする
document.addEventListener('keydown', function(event) {
  if (event.ctrlKey && event.key === 's') {
      event.preventDefault(); 
      return false;
  }
});

// 
const textarea = document.getElementById('myTextarea');
    
    textarea.addEventListener('input', function(event) {
        document.getElementById('saveAreaLg').classList.toggle('hidden')
        document.getElementById('saveArea').classList.toggle('hidden')
        
    });