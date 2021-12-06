export default () => ({

  move: 'move-right',
  head: 0,

  get active() {
    return this.head % this.slidesCount
  },

  slidesCount: 0,

  init() {
    this.$nextTick(() => {
      this.slidesCount = this.$refs.container.childElementCount
    })
  },

  next(val) {
    this.move = val === 1 ? 'move-right' : 'move-left'
    if (this.head + val < 0) {
      val += this.slidesCount
    } 
    this.head += val
  },

  activate(index) {
    if (index === this.activate) return
    else if (index > this.active) this.move = 'move-right'
    else this.move = 'move-left'
    this.head = index
  }

})