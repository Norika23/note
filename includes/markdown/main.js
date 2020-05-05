"use strict";

$(function() {
  const $note_content = $(".note_content");

  // カスタムRendererを取得する
  const renderer = new marked.Renderer();

  // リンクの変換処理を変更する
  renderer.link = (href, title, text) => {
    return `<a href="${href}" target="_blank">${text}</a>`
  }

  // Markedのオプションを設定
  marked.setOptions({
    renderer: renderer,
    breaks: true,
    sanitize: true,
    highlight: (code) => {
      return hljs.highlightAuto(code).value;
    },
  });

  // テキスト入力ハンドラ
  // $(".textarea").on("input", (e) => {
    // 入力内容を取得する
    const text = $('.note_content').text();
    // HTMLに変換する
    const html = marked(text);
    // プレビューに表示する
    $note_content.empty().append(html);
  // });

  // ----------------------------------
  // 初回表示時になにかマークダウンを表示させるためのコード
  

});