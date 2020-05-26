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

  <div id="creacionAnuncio">
    <?php
      if( isset($_GET['user']) && isset($_GET['key']) ){
        $usuario = $_GET['user'];
        $key = $_GET['key'];
        $estado = 1;
      }
      ?>
      <div style="display: none">
      {{ usuario = '<?php  echo $usuario?>' }}
      {{ contrasena = '<?php  echo $key?>'}}
      {{ estado = <?php  echo $estado?>}}
      {{validarDatos()}}
    </div>
    <v-app>
      <v-form
        ref="form2"
        v-model="valid2"
        lazy-validation
        method="post"
        action="crearUsuario.php"
      ><br>


      <center><v-toolbar-title center>CREACION DE ANUNCIO</v-toolbar-title></center>

      <v-text-field
        v-model="titulo"
        :counter="40"
        :rules="tituloRules"
        label="Titulo del anuncio"
        hint="Maximo 40 caracteres"
        counter
        required
      ></v-text-field>

      <v-combobox
          v-model="categoria"
          :items="itemsCategoria"
          label="Selecciona la categoria del anuncio"
          value="Vehiculos"
            required

        ></v-combobox>

        <v-textarea
                    v-model="caracGenerales"
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
                         :rules="caracGeneralesRules"
                           required

                  ></v-textarea>

                  <v-textarea
                              v-model="caracEspecificas"
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
                               label="Caracteristicas Especificas"
                               counter
                               hint="Maximo 200 caracteres"
                               :rules="caracEspecificasRules"
                                 required

                            ></v-textarea>


                            <v-text-field
                              v-model="lugar"
                              :counter="50"
                              :rules="lugarRules"
                              label="Lugar donde aplica el anuncio"
                              hint="Maximo 50 caracteres"
                              counter
                              required
                            ></v-text-field>

                            <v-file-input type="file" id="file" ref="file"label="Selecciona tu imagen"
                            prepend-icon="mdi-camera" v-model="foto" > </v-file-input>
                            <v-btn
                              :disabled="!valid2"
                              color="success"
                              class="mr-4"
                              @click="registrarAnuncio()"
                              name="btn2"
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

  <script src="../js/creacionAnuncio.js"> </script>
</body>
</html>
