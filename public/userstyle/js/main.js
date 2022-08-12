// function getSelectionText() {
//     var text = "";
//     if (window.getSelection) {
//         text = window.getSelection().toString();
//     } else if (document.selection && document.selection.type != "Control") {
//         text = document.selection.createRange().text;
//     }
//     return text;
// }
// $(document).ready(function() {
//     $(document).bind("mouseup", function() {
//         var selectedText = getSelectionText();
//         if (selectedText != '') {
//             menu(selectedText)
//         }
//     });
// });

// const menu = (selectedText) => {

//     $("#staticBackdrop").modal("show")
//     $("#show").text(selectedText)

// }

// $(".btn-dismiss").on("click", function() {
//     $("#staticBackdrop").modal("hide")
//     clearSelection()
// })

// const clearSelection = () => {
//     if (window.getSelection) { window.getSelection().removeAllRanges(); } else if (document.selection) { document.selection.empty(); }
// }


// var control = document.importNode(document.querySelector('template').content, true).childNodes[0];
// control.addEventListener('pointerdown', oncontroldown, true);

// document.querySelector('p').onpointerup = () => {
//     let selection = document.getSelection(),
//         text = selection.toString();
//     if (text !== "") {
//         let rect = selection.getRangeAt(0).getBoundingClientRect();
//         control.style.top = `calc(${rect.top}px - 48px)`;
//         control.style.left = `calc(${rect.left}px + calc(${rect.width}px / 2) - 40px)`;
//         control['text'] = text;
//         document.body.appendChild(control);
//         document.querySelector('#tweet').addEventListener('pointerdown', ontweetdown, true);
//         document.querySelector('#telegram').addEventListener('pointerdown', ontelegramdown, true);
//         document.querySelector('#whatsapp').addEventListener('pointerdown', onwhatsappdown, true);

//     }
// }

// function oncontroldown(event) {
//     document.getSelection().removeAllRanges();
//     this.remove();
// }

// function ontweetdown(event) {
//     window.open(`https://twitter.com/intent/tweet?text=${this.parentNode.text}`)
//     event.stopPropagation();
// }

// function ontelegramdown(event) {
//     window.open(`https://t.me/share/url?url=example.com&text=${this.parentNode.text}`)
//     event.stopPropagation();
// }

// function onwhatsappdown(event) {
//     window.open(`https://api.whatsapp.com/send/?text=${this.parentNode.text}`)
//     event.stopPropagation();
// }
// document.onpointerdown = () => {
//     let control = document.querySelector('#control');
//     if (control !== null) { control.remove();
//         document.getSelection().removeAllRanges(); }
// }