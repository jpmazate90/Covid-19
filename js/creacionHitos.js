new Vue({
  el: '#creacionHitos',
  data: {
      valor: "hola",
      valid3: true,
      usuario: 'd',
      contrasena: 'f',
      mostrar:1,
      estado : 0,
      hitoTitulo:'',
      hitoCategoria:'',
      hitoDetalle:'',
      hitoFechaForm:'2000-01-01',
      hitoFuente:'',
      hitoComentario:'',

      hitoItemsCategoria: [
          'Peligroso',
          'Impactante',
          'Testimonio',
          'Otros',
        ],


        hitoDetalleRules: [
          v => (v && v.length <= 200) || 'El maximo es de 200 caracteres',
        ],

        hitoTituloRules: [
          v => (v && v.length <= 40) || 'El titulo tiene que tener maximo 40 caracteres',
        ],

        hitoFuenteRules: [
          v => (v && v.length >0)  || 'Debe de tener fuente del hito',
        ],
        hitoComentarioRules: [
          v => (v && v.length <= 200) || 'El maximo es de 200 caracteres',
        ],

  },
  methods:{
    validarDatos () {
      let formData = new FormData()
      formData.append("usuario",this.usuario)
      formData.append("contrasena",this.contrasena)
      const url = "../php/validacionInicioSesion.php"
      axios.post(url,formData).then(function (response) {
        if(response.data.result === false){
          window.location.href = './login.html'
        }else{
          this.perfilImagen = String(response.data.imagen)
          console.log("esta bien")
          console.log(this.perfilImagen)
        }

      }).catch(function (error){
        alert("Surgio un error al intentar enviar la peticion")
        console.log(error)
      })
    },
    onFileSelected(event){
      this.selectedFile = event
    },

    mandarFormulario: function(){

      this.file = this.foto;
      //this.file = this.$refs.file.files[0];

      let formData = new FormData();
      formData.append('file', this.file);
      formData.append('usuario', this.usuario);

      axios.post('../php/subirImagenPerfil.php', formData,
      {
         headers: {
           'Content-Type': 'multipart/form-data'
         }
      })
      .then(function (response) {
         if(!response.data.result){
            console.log('File not uploaded.')
         }else{
           this.perfilImagen = String(response.data.path)
            console.log('File uploaded successfully.')
            console.log('esta es la nueva ruta:'+this.perfilImagen)
         }

      })
      .catch(function (error) {
          console.log(error);
      });

    },

    registrarHito(){
      console.log('registrare un hito')
    }





  },
  vuetify: new Vuetify(),
})
