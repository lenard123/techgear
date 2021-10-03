
document.addEventListener('alpine:init', function () {

  Alpine.data('productImagePreview', () => ({
    source: null,

    previewFile: function (e) {

      const [file] = e.target.files

      if (file) {
        this.source = URL.createObjectURL(file);
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

