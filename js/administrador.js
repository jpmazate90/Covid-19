var vm = new Vue({
  el: '#administrador',
  data: {
    autoGrow: true,
   autofocus: true,
   clearable: false,
   counter: 0,
   filled: true,
   flat: false,
   hint: '',
   label: '',
   loading: false,
   model: 'I\'m a textarea.',
   noResize: false,
   outlined: false,
   persistentHint: false,
   placeholder: '',
   rounded: false,
   rowHeight: 50,
   rows: 1,
   shaped: false,
   singleLine: false,
   solo: false,
    //
    valid9:true,
    mostrarInicio: 0,
    usuario:'',
    contrasena:'',
    estado:0,
    mostrarInformacionGeneral:1,
    fotoImagen:null,
    //datos formulario
    tituloInformacion:'',
    categoriaInformacion:'',
    comentarioInformacionGeneral:'',
    imagenesInfoGeneral:[],
    //vista informacion general
    carrousel:0,
    filtroCategoriaInformacion:'',
    mostrarFiltrosInformacionGeneral:false,

    //filtro anuncios
    anunciosDashboard:[],
    filtroLugar: '',
    filtroCategoria:'',
    filtroUsuario:'',
    filtroInicioFecha:'',
    filtroFinFecha:'',
    mostrarFiltrosAnuncios:false,
    itemsCategoria: [
        'Juegos',
        'Vehiculos',
        'Comida',
        'Otros',
      ],

      //FILTROS Hitos
      hitosDashboard:[],
      mostrarFiltrosHitos:false,
      filtroHitoCategoria:'',
      filtroHitoUsuario:'',
      filtroHitoInicioFecha:'',
      filtroHitoFinFecha:'',
      filtroHitoPopularidad:'',
      filtroHitoAprobado:'',
      mostrarFiltrosHitos:false,
      botonesMostrarComentarios:[],
      escribirComentarioHitos:[],
      comentariosHitos:[],


      hitoItemsAprobados: [
          'Aprobado',
          'No Aprobados'
        ],

      hitoItemsPopularidad: [
          'Likes',
          'Dislikes'
        ],
      hitoItemsCategoria: [
          'Peligroso',
          'Impactante',
          'Testimonio',
          'Otros',
        ],
// usuariosSistema
usuariosSistema:[],
mostrarFiltrosUsuario:false,
filtroNombreUsuario:'',
filtroUsuarioInicioFecha:'',
filtroUsuarioFinFecha:'',
filtroUsuarioTipo:'',
itemsUsuarioTipo: [
    'Comun',
    'Administrador'
  ],
  //creacion Administrador
  show2:false,
  show3:false,
  valid2:true,
  usuarioForm:'',
  contrasenaForm:'',
  contrasenaRepetidaForm:'',
  nombreForm: '',
  fechaForm: '2020-01-01',
  correoElectronicoForm: '',
  email: '',
  name: '',
  usuarioRules: [
    v => !!v || 'El usuario es requerido',
  ],

  contrasenaRules: [
    v => !!v || 'Contrasena es requerida',
  ],

  usuarioFormRules: [
    v => (v && v.length <= 30) || 'El usuario tiene que tener maximo 30 caracteres',
  ],
  contrasenaFormRules: [
    v => (v && v.length <= 10) || 'La Contrasena tiene que tener maximo 10 caracteres',
  ],
  contrasenaRepetidaFormRules: [
    v => (v && v.length <= 10) || 'La Contrasena tiene que tener maximo 10 caracteres',
  ],
  nombreFormRules: [
    v => (v && v.length <= 40) || 'El nombre completo tiene que tener maximo 40 caracteres',
  ],
  correoFormRules:[
    v => /.+@.+\..+/.test(v) || 'Correo no valido',

  ],


    tituloInformacionRules: [
      v => (v && v.length <= 40) || 'El titulo tiene que tener maximo 40 caracteres',
    ],
    comentarioInformacionRules: [
      v => (v && v.length <= 200) || 'El maximo es de 200 caracteres',
    ],

    categoriaInformacionItems: [
        'SALUD',
        'INFORMACION',
        'RECOMENDACIONES',
        'OTROS'
      ],


  },
  methods: {
    validarDatos () {
      if(this.usuario==='USUARIO' && this.contrasena===''){
        window.location.href = './login.html'
      }else{
      let formData = new FormData()
      formData.append("usuario",this.usuario)
      formData.append("contrasena",this.contrasena)
      const url = "../php/validacionInicioSesion.php"
      axios.post(url,formData).then((response) => {
        if(response.data.result === false){
          window.location.href = './login.html'
        }else{
          this.perfilImagen = response.data.imagen
          this.nombreCompleto = response.data.nombreCompleto
          this.correo = response.data.correo

          this.confianza = parseInt(response.data.confianza,10)
        }



      }).catch( (error)=>{
        alert("Surgio un error al intentar enviar la peticion")
        console.log(error)
      })
    }

    },
    salir(){
      window.location.href = './login.html'

    },
    registrarInformacionGeneral: function(){
      this.file = this.fotoImagen
      //this.file = this.$refs.file.files[0];
      let formData = new FormData()
      formData.append('file', this.file)
      formData.append('titulo', this.tituloInformacion)
      formData.append('usuario', this.usuario)
      formData.append('comentario', this.comentarioInformacionGeneral)
      formData.append('categoria', this.categoriaInformacion)
      axios.post('../php/registrarInformacionGeneral.php', formData,
      {
         headers: {
           'Content-Type': 'multipart/form-data'
         }
      })
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           alert(response.data.mensaje)
           this.mostrarInformacionGeneral=0
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    verPublicaciones(){
      this.mostrarInformacionGeneral = 2
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboard')
      axios.post('../php/mostrarInformacionGeneral.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.imagenesInfoGeneral = response.data.datos
         }
      })
      .catch((error) =>{
          console.log(error);
      })

    },
    aplicarFiltrosInformacion(){
      console.log(this.filtroCategoriaInformacion)
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardFiltros')
      formData.append('categoria', this.filtroCategoriaInformacion)
      axios.post('../php/mostrarInformacionGeneral.php', formData)
      .then( (response) => {
        if(!response.data.result){
           alert(response.data.mensaje)
        }else{
          this.carrousel = 0
          var i =0
          this.imagenesInfoGeneral = []
          for (i = 0; i < response.data.datos.length; i++) {
              vm.$set(this.imagenesInfoGeneral,i,response.data.datos[i])
          }
          console.log("datos")
          console.log(this.imagenesInfoGeneral)
        }
      })
      .catch((error) =>{
          console.log(error);
      })
    },filtrarAnuncios(){
      console.log('categoria: '+this.filtroCategoria)
      console.log('vendedor: '+this.filtroUsuario)
      console.log('iniciofecha: '+this.filtroInicioFecha)
      console.log('finFecha: '+this.filtroFinFecha)


      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardAdminFiltros')
      formData.append('categoria', this.filtroCategoria)
      formData.append('lugar', this.filtroLugar)
      formData.append('vendedor', this.filtroUsuario )
      formData.append('fechaInicio', this.filtroInicioFecha )
      formData.append('fechaFin', this.filtroFinFecha )
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard = response.data.datos
           console.log(this.anunciosDashboard)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    reiniciarFechas:function(){
      this.filtroInicioFecha = ''
      this.filtroFinFecha = ''
    },
    aprobarAnuncio(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'aprobar')
      formData.append('id', this.anunciosDashboard[indice].Id)
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard[indice].Aprobado = 1
           this.anunciosDashboard[indice].Estado = 1
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })

    },
    rechazarAnuncio(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'rechazar')
      formData.append('id', this.anunciosDashboard[indice].Id)
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard[indice].Aprobado = 2
           this.anunciosDashboard[indice].Estado = 2
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    despublicarAnuncio(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'despublicar')
      formData.append('id', this.anunciosDashboard[indice].Id)
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard[indice].Estado = 2
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    republicarAnuncio(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'republicar')
      formData.append('id', this.anunciosDashboard[indice].Id)
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard[indice].Estado = 1
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    verDashboardAnuncios: function(){
      this.mostrarInicio = 4;
      this.mostrarAnunciosGenerales()
    },
    verDashboardHitos: function(){
      this.mostrarInicio = 5
      this.mostrarHitosGenerales()
    },
    mostrarAnunciosGenerales(){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardAdmin')
      axios.post('../php/mostrarAnuncios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.anunciosDashboard = response.data.datos
           console.log(this.anunciosDashboard)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    mostrarHitosGenerales(){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardAdmin')
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.hitosDashboard = response.data.datos
           var i=0
           this.comentariosHitos=[]
           for (i = 0; i < response.data.datos.length; i++) {
             this.escribirComentarioHitos.push({ 'IdHito': response.data.datos[i].Id , 'Comentario':'','Imagen':''});
             this.botonesMostrarComentarios.push({ 'Mostrar':false});
             this.mostrarComentariosHitos(response.data.datos[i].Id)
           }

           console.log(this.hitosDashboard)
           console.log(this.escribirComentarioHitos)
           console.log(this.comentariosHitos)
         }
      })
      .catch((error) =>{
          console.log(error);
      })
    },mostrarComentariosHitos(parametro){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboard')
      formData.append('idHito', parametro)
      axios.post('../php/mostrarComentarios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           if(response.data.datos.length>0){
               this.comentariosHitos.push(response.data.datos)
           }

         }
      })
      .catch((error) =>{
          console.log(error);
      })
    },
    filtrarHitos(){
      console.log('categoria: '+this.filtroHitoCategoria)
      console.log('vendedor: '+this.filtroHitoUsuario)
      console.log('iniciofecha: '+this.filtroHitoInicioFecha)
      console.log('finFecha: '+this.filtroHitoFinFecha)
      console.log('Popularidad: '+this.filtroHitoPopularidad)
      console.log('Aprobado: '+this.filtroHitoAprobado)



      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardFiltrosAdmin')
      formData.append('categoria', this.filtroHitoCategoria)
      formData.append('vendedor', this.filtroHitoUsuario )
      formData.append('fechaInicio', this.filtroHitoInicioFecha )
      formData.append('fechaFin', this.filtroHitoFinFecha )
      formData.append('popularidad', this.filtroHitoPopularidad )
      formData.append('aprobado', this.filtroHitoAprobado)
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.hitosDashboard = response.data.datos
           var i=0
           this.comentariosHitos=[]
           for (i = 0; i < response.data.datos.length; i++) {
             this.escribirComentarioHitos.push({ 'IdHito': response.data.datos[i].Id , 'Comentario':'','Imagen':''});
             this.botonesMostrarComentarios.push({ 'Mostrar':false});
             this.mostrarComentariosHitos(response.data.datos[i].Id)
           }

           console.log(this.hitosDashboard)
           console.log(this.escribirComentarioHitos)
           console.log(this.comentariosHitos)
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    aprobarHito(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'aprobar')
      formData.append('id', this.hitosDashboard[indice].Id)
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.hitosDashboard[indice].Aprobado = 1
           this.hitosDashboard[indice].Estado = 1
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })

    },
    rechazarHito(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'rechazar')
      formData.append('id', this.hitosDashboard[indice].Id)
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.hitosDashboard[indice].Aprobado = 2
           this.hitosDashboard[indice].Estado = 2
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })

    },
    despublicarHito(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'despublicar')
      formData.append('id', this.hitosDashboard[indice].Id)
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{

           this.hitosDashboard[indice].Estado = 2
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })

    },
    republicarHito(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'republicar')
      formData.append('id', this.hitosDashboard[indice].Id)
      axios.post('../php/mostrarHitos.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{

           this.hitosDashboard[indice].Estado = 1
           console.log(response.data.mensaje)
         }

      })
      .catch((error) =>{
          console.log(error);
      })

    },
    reiniciarUsuarioFechas(){
      this.filtroUsuarioFinFecha=''
      this.filtroUsuarioInicioFecha=''
    },
    verDashboardUsuarios(){
      this.mostrarInicio = 6
      this.mostrarUsuarios();
    },

    mostrarUsuarios(){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardAdmin')
      axios.post('../php/mostrarUsuarios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.usuariosSistema= response.data.datos
         }
      })
      .catch((error) =>{
          console.log(error);
      })
    },
    filtrarUsuarios(){

      console.log('usuario: '+this.filtroNombreUsuario)
      console.log('iniciofecha: '+this.filtroUsuarioInicioFecha)
      console.log('finFecha: '+this.filtroUsuarioFinFecha)
      console.log('tipoUsuario: '+this.filtroUsuarioTipo)


      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'dashboardAdminFiltros')
      formData.append('nombre', this.filtroNombreUsuario )
      formData.append('fechaInicio', this.filtroUsuarioInicioFecha )
      formData.append('fechaFin', this.filtroUsuarioFinFecha )
      formData.append('usuarioTipo', this.filtroUsuarioTipo )
      axios.post('../php/mostrarUsuarios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.usuariosSistema = response.data.datos
         }

      })
      .catch((error) =>{
          console.log(error);
      })
    },
    habilitarUsuario(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'habilitar')
      formData.append('id', this.usuariosSistema[indice].Usuario)

      axios.post('../php/mostrarUsuarios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.usuariosSistema[indice].Estado = 1
         }
      })
      .catch((error) =>{
          console.log(error);
      })

    },deshabilitarUsuario(indice){
      let formData = new FormData()
      formData.append('usuario', this.usuario)
      formData.append('tipo', 'deshabilitar')
      formData.append('id', this.usuariosSistema[indice].Usuario)

      axios.post('../php/mostrarUsuarios.php', formData)
      .then( (response) => {
         if(!response.data.result){
            alert(response.data.mensaje)
         }else{
           this.usuariosSistema[indice].Estado = 0
         }
      })
      .catch((error) =>{
          console.log(error);
      })
    },
    crearUsuarioAdmin(){
      this.mostrarInicio = 7
    },
    registrarAdministrador(){
        this.$refs.form2.validate()
        if(this.contrasenaForm === this.contrasenaRepetidaForm){

        let formData = new FormData()
        formData.append("usuario",this.usuarioForm)
        formData.append("contrasena",this.contrasenaForm)
        formData.append("nombre",this.nombreForm)
        formData.append("correo",this.correoElectronicoForm)
        formData.append("fecha",this.fechaForm)
        formData.append("imagen",'NULL')
        formData.append("confianza",100)
        formData.append("tipo",2)
        const url = "../php/crearUsuario.php"
        axios.post(url,formData).then(function (response) {
                    if(response.data.result){
                      alert(response.data.mensaje)
                    }else{
                      alert(response.data.mensaje)
                    }
        }).catch(function (error){
          console.log(error)
          alert("Surgio un error al intentar enviar la peticion")
        })
      }else{
        alert("Las contrasenas no coinciden")
      }

    }


  },
  vuetify: new Vuetify(),
})
