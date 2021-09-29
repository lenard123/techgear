
document.addEventListener('alpine:init', function () {

  let previousActiveCategory = null
  
  Alpine.data('category', () => ({
    isActive: false,

    openEditForm() {
      previousActiveCategory?.close()
      previousActiveCategory = this
      this.isActive = true
    },

    close() {
      this.isActive = false
    },

    submit() {
      this.$refs.editForm.submit()
    }

  }))

})
