new Vue({
  el: '#app',
  data: {
    valorN: 1

  },
  methods: {
    cambiar(){
      window.location.href = './paginas/dashboard.php'

    }
  },
  vuetify: new Vuetify(),
})
