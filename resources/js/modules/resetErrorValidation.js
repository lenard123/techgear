export default () => ({
  removeErrorMessage() {
    this.$refs?.errorMessage?.remove()
    this.$refs?.input?.classList?.remove('error')
  }
})