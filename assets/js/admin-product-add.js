"use strict";

document.addEventListener('alpine:init', function () {
  ClassicEditor.create(document.querySelector('#editor')).then(function (editor) {
    console.log(editor);
  })["catch"](function (error) {
    console.error(error);
  });
});