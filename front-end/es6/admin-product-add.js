
document.addEventListener('alpine:init', function () {

  Alpine.data('productImagePreview', () => ({

    status: 0,

    source: null,

    cropper: null,

    cropperConfig: {
      aspectRatio: 4 / 3,
      viewMode: 1, //Restrict the cropper to the image
    },

    croppedImage: null,

    getBlobAsync(){
      return new Promise((resolve, reject) => {
        if (this.cropper === null) {
          reject('There still no data in cropper')
        } else {
          this.cropper.getCroppedCanvas().toBlob((result) => {
            resolve(result)
          })
        }
      })
    },

    cropImage() {
      console.log(this)
      this.$nextTick(() => {
        const imageEl = this.$refs.previewImage;
        this.cropper = new Cropper(imageEl, this.cropperConfig);
      })
    },

    cancel() {
      this.cropper.destroy()
      this.cropper = null
      this.source = null
      this.status = 0
      this.$refs.finalInput.files = null
    },

    async saveAsync() {
      const blob = await this.getBlobAsync()
      const file = new File([blob], 'croppedImage.png');
      const dt = new DataTransfer()

      dt.items.add(file)
      this.$refs.finalInput.files = dt.files
      this.$refs.previewImageToBeUploaded.src = URL.createObjectURL(file)
      this.status = 2
    },

    preventIfHasFile(e) {
      if (this.source !== null) {
        e.preventDefault();
      }
    },


    previewFile: function (e) {

      const [file] = e.target.files

      if (file) {
        this.source = URL.createObjectURL(file);
        this.cropImage();
        this.status = 1
      }

    }

  }));


  ClassicEditor
  .create( document.querySelector( '#editor' ) )
  .then( editor => {
    console.log( editor );
  } )
  .catch( error => {
    console.error( error );
  } );
})

