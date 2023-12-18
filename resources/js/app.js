import './bootstrap';
// const result = document.querySelector('#result');
// result.addEventListener('keydown', function (event) {
//     const listId = document.getElementById('list1');
//     if (listId !== null) {
//         listId.addEventListener('keydown', function (event) {
//             let target = event.target;
//             let next = null;
//             // console.log(document.querySelector('#list1 label'));
//             // 矢印キーの判定とフォーカス移動先の取得
//             if (event.key === 'ArrowDown') {
//                 next = target.nextElementSibling;
//                 console.log('↓↓↓');
//             } else if (event.key === 'ArrowUp') {
//                 next = target.previousElementSibling;
//                 console.log('↑↑↑');
//             }

//             // フォーカスを移動
//             if (next && next.tagName === 'LI') {
//                 next.focus();
//                 event.preventDefault();
//             }
//         });
//     } else {
//         console.log('bbb');
//     }
// });
button.addEventListener('click', event => {
  bars.classList.toggle('hidden')
  xmark.classList.toggle('hidden')
  menu.classList.toggle('translate-x-full')
});

