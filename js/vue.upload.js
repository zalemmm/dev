new Vue({

  //---------------------------------------------------------------------------------------------//
  //                0 - EL (élément html sur lequel agit le code ci dessous)                     //
  //---------------------------------------------------------------------------------------------//

  el: '#fbcart_cart',

  //---------------------------------------------------------------------------------------------//
  //                1 - DATA ( variables et valeurs par défaut de la VUE)                        //
  //---------------------------------------------------------------------------------------------//

  data: function()  {
      return {
        files: ''
      };
  },

  methods: {

      // Select the files
      //------------------------------------------------------------------------
      addFiles: function() {
        this.$refs.files.click();
      },


      // Submits files to the server
      //------------------------------------------------------------------------
      submitFiles: function() {

        var formData = new FormData();

        for( var i = 0; i < this.files.length; i++ ){
          var file = this.files[i];

          formData.append('files[' + i + ']', file);
        }

        axios.post( '../fb_upload_client.php',
          formData,
          {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
          }
        ).then(function(){
          console.log('SUCCESS!!');
        })
        .catch(function(){
          console.log('FAILURE!!');
        });
      },

      // Submits files to the server
      //------------------------------------------------------------------------
      handleFilesUpload: function() {
        this.files = this.$refs.files.files;
      },

  }

});
