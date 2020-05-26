<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body >

  <div id="creacionHitos">

    <v-app>
      <v-form
        ref="form2"
        v-model="valid3"
        lazy-validation
        method="post"
        action="crearUsuario.php"
      ><br>


      <center><v-toolbar-title center>CREACION DE HITO</v-toolbar-title></center>

      <v-text-field
        v-model="hitoTitulo"
        :counter="40"
        :rules="hitoTituloRules"
        label="Titulo del Hito"
        hint="Maximo 40 caracteres"
        counter
        required
      ></v-text-field>


      <v-combobox
          v-model="hitoCategoria"
          :items="hitoItemsCategoria"
          label="Selecciona la categoria del hito"
          value="Peligroso"
            required
        ></v-combobox>

        <v-textarea
                    v-model="hitoDetalle"
                    :auto-grow="autoGrow"
                    :clearable="clearable"
                    :counter="counter ? counter : false"
                    :filled="filled"
                    :flat="flat"
                    :hint="hint"
                    :label="label"
                    :loading="loading"
                    :no-resize="noResize"
                    :outlined="outlined"
                    :persistent-hint="persistentHint"
                    :placeholder="placeholder"
                    :rounded="rounded"
                    :row-height="rowHeight"
                    :rows="rows"
                    :shaped="shaped"
                    :single-line="singleLine"
                    :solo="solo"
                    label="Caracteristicas Generales"
                    counter
                    hint="Maximo 200 caracteres"
                    :rules="hitoDetalleRules"
                    required
                  ></v-textarea>


                    <v-text-field
                      v-model="hitoFuente"
                      :rules="hitoFuenteRules"
                      label="Fuente del hito"
                      hint="Sin limite de caracteres"
                      counter
                      required
                    ></v-text-field>

                  <v-textarea
                              v-model="hitoComentario"
                              :auto-grow="autoGrow"
                              :clearable="clearable"
                              :counter="counter ? counter : false"
                              :filled="filled"
                              :flat="flat"
                              :hint="hint"
                              :label="label"
                              :loading="loading"
                              :no-resize="noResize"
                              :outlined="outlined"
                              :persistent-hint="persistentHint"
                              :placeholder="placeholder"
                              :rounded="rounded"
                              :row-height="rowHeight"
                              :rows="rows"
                              :shaped="shaped"
                              :single-line="singleLine"
                              :solo="solo"
                              label="Comentario"
                              counter
                              hint="Maximo 200 caracteres"
                              :rules="hitoComentarioRules"
                              required

                  ></v-textarea>

                  <v-date-picker
                      v-model="hitoFechaForm"
                      class="mt-4"
                      min="1900-01-01"
                      max="2040-01-01"
                    ></v-date-picker><br><br>

                    <v-btn
                      :disabled="!valid3"
                      color="success"
                      class="mr-4"
                      @click="registrarHito()"
                      name="btn3"
                      required
                    >  Registrar Anuncio
                    </v-btn>






  <br><br>

    </v-form>

    </v-app>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>

  <script src="../js/creacionHitos.js"> </script>
</body>
</html>
