export default (source) => ({

  source,

  input: null,

  name: 'product.jpg',

  size: 0,

  get sizeHumanReadable() {

    if (! this.size) return 'Unknown file size'

    const size = this.size
    const i = Math.floor( Math.log(size) / Math.log(1024) );
    return ( size / Math.pow(1024, i) ).toFixed(2) * 1 + ' ' + ['B', 'kB', 'MB', 'GB', 'TB'][i];
  },

  init() {
    this.$nextTick(() => {
      this.input = this.$refs.input
    })
  },

  imageChanged(e) {

    const [file] = e.target.files

    if (file) {
      this.source = URL.createObjectURL(file)
      this.name = file.name
      this.size = file.size
    }

  },

  clearImage() {
    this.source = null
    this.input.files = null
  }
})