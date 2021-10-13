
document.addEventListener('alpine:init', () => {

  const OrderDetails = function (classNames, defaultColor) {
    return {
      status: php_order_status,
      classNames,
      get orderProgress() {
        return this.classNames[this.status - 1]
      },
      bg: function(status) {
        return status === this.status ? defaultColor : '';
      }
    }
  }

  Alpine.data('OrderDetails', OrderDetails)

})