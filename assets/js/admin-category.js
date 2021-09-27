"use strict";

document.addEventListener('alpine:init', function () {
  var previousActiveCategory = null;
  Alpine.data('category', function () {
    return {
      isActive: false,
      openEditForm: function openEditForm() {
        var _previousActiveCatego;

        (_previousActiveCatego = previousActiveCategory) === null || _previousActiveCatego === void 0 ? void 0 : _previousActiveCatego.close();
        previousActiveCategory = this;
        this.isActive = true;
      },
      close: function close() {
        this.isActive = false;
      },
      submit: function submit() {
        this.$refs.editForm.submit();
      }
    };
  });
});