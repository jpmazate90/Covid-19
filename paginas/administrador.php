 <!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.min.css" rel="stylesheet">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">
</head>
<body>
  <div id="administrador">

    <v-app>
      <div>
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

    <v-toolbar dark prominent src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">


      <v-spacer></v-spacer>




      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-app-bar-nav-icon>
        <v-btn @click="mostrarInicio = 3">
          Informacion General

        </v-btn>



      </v-app-bar-nav-icon>

      <v-spacer></v-spacer>

      <v-app-bar-nav-icon>
        <v-btn @click="verDashboardAnuncios()">
          Verificar anuncios
        </v-btn>

      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-app-bar-nav-icon>

        <v-btn @click="verDashboardHitos()">
          Verificar Hitos
       </v-btn>

      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-app-bar-nav-icon>
        <v-btn @click="verDashboardUsuarios()">
          Ver Usuarios
        </v-btn>

      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>

      <v-app-bar-nav-icon>
        <v-btn @click="crearUsuarioAdmin()">
          Crear Admin
        </v-btn>

      </v-app-bar-nav-icon>


      <v-toolbar-title> {{usuario}} </v-toolbar-title>

      <v-spacer></v-spacer>

      <v-btn icon @click="salir()">
        <v-icon>mdi-export</v-icon>
        Salir
      </v-btn>
    </v-toolbar>

    <div v-if="mostrarInicio === 3 ">
      <center><v-toolbar-title >    INFORMACION GENERAL </v-toolbar-title></center>

      <v-btn
        color="blue"
        dark
        class="mr-4"
        @click="mostrarInformacionGeneral = 1"
        name="btn6"
        required
      >  Crear Publicacion</v-btn>

    <v-btn
      color="brown"
      dark
      class="mr-4"
      @click="verPublicaciones()"
      name="btn6"
      required
    >  Ver Publicaciones
  </v-btn>

      <div v-if="mostrarInformacionGeneral === 1">
        <v-form
          ref="form2"
          v-model="valid9"
          lazy-validation
        ><br>



        <center><v-toolbar-title center>CREACION DE INFORMACION GENERAL</v-toolbar-title></center>

        <v-text-field
          v-model="tituloInformacion"
          :counter="40"
          :rules="tituloInformacionRules"
          label="Titulo de la publicacion"
          hint="Maximo 40 caracteres"
          counter
          required
        ></v-text-field>


        <v-combobox v-model="categoriaInformacion" :items="categoriaInformacionItems" label="Ingresa la categoria"
           ></v-combobox>

          <v-textarea
                      v-model="comentarioInformacionGeneral"
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
                      label="Detalle"
                      counter
                      hint="Maximo 200 caracteres"
                      :rules="comentarioInformacionRules"
                      required
                    ></v-textarea>

                    <v-file-input type="file" id="file" ref="file" label="Selecciona tu imagen" prepend-icon="mdi-camera"
                      v-model="fotoImagen" placeholder="Extensiones validas: jpg, jpeg, png y pdf"> </v-file-input>


                      <v-btn
                        :disabled="!valid9"
                        color="success"
                        dark
                        class="mr-4"
                        @click="registrarInformacionGeneral()"
                        name="btn3"
                        required
                      >  Crear Publicacion
                    </v-btn>
                      <br><br>
        </v-form>
      </div>

      <div v-else>
        <br><br>

        <center><v-toolbar-title > {{imagenesInfoGeneral[carrousel].Titulo}} </v-toolbar-title>
        <v-card-subtitle class="pb-0">  {{imagenesInfoGeneral[carrousel].Comentario}}</v-card-subtitle></b>
        <v-card-subtitle class="pb-0"> Categoria: {{imagenesInfoGeneral[carrousel].Categoria}}</v-card-subtitle></b>
        <v-card-subtitle class="pb-0"> Fecha de Publicacion: {{imagenesInfoGeneral[carrousel].FechaPublicacion}}</v-card-subtitle></b></center>

        <v-carousel  cycle interval="6000"  height="auto" v-model="carrousel">
          <center><v-carousel-item
          v-for="(item,i) in imagenesInfoGeneral"
          :key="i"
          :src="item.Imagen"
             style="width:70%;height:40%;" :alt="item.Imagen"
          >
        </v-carousel-item> </center>
      </v-carousel>





    </div>
  </div>
    <div v-else-if="mostrarInicio === 4 ">
      VERIFICAR ANUNCIOS
      <div>
        <center><v-toolbar-title > <h1> Anuncios de la Comunidad</h1> </v-toolbar-title></center>
        <v-btn
          color="blue"
          class="mr-4"
          @click="mostrarFiltrosAnuncios = !mostrarFiltrosAnuncios"
          name="btn6"
          required
        >  Mostrar Filtros
      </v-btn><br>

       <div v-if="mostrarFiltrosAnuncios">

        <v-toolbar-title > Filtros </v-toolbar-title>
        <v-combobox v-model="filtroCategoria" :items="itemsCategoria" label="Si quieres filtrar por categoria"
           ></v-combobox>
           <v-text-field
             v-model="filtroUsuario"
             :counter="40"
             label="Si quieres filtrar por usuario"
             hint="Maximo 40 caracteres"
             counter
             required
           ></v-text-field>
           <v-text-field
             v-model="filtroLugar"
             :counter="40"
             label="Si quieres filtrar por lugar"
             hint="Maximo 40 caracteres"
             counter
             required
           ></v-text-field>
           <div> Fecha Inicio</div>
           <v-date-picker
               label="Si quieres filtrar por fechas"
               v-model="filtroInicioFecha"
               class="mt-4"
               min="1900-01-01"
               max="2040-01-01"
             ></v-date-picker>
             <div> Fecha Fin</div>
             <v-date-picker
                label="Si quieres filtrar por fechas"
                 v-model="filtroFinFecha"
                 class="mt-4"
                 min="1900-01-01"
                 max="2040-01-01"
               ></v-date-picker><br><br>
               <v-btn
                 color="success"
                 class="mr-4"
                 @click="filtrarAnuncios()"
                 name="btn5"
                 required
               >  Filtrar Anuncios
             </v-btn>
             <v-btn
               color="success"
               class="mr-4"
               @click="reiniciarFechas()"
               name="btn6"
               required
             >  Reiniciar Fechas
           </v-btn>
         </div>

        <v-container class="pa-4 text-center">
          <v-row class="fill-height" align="center" justify="center">
            <div v-for="(item, i) in anunciosDashboard">
              <v-col :key="i" cols="20" md="8" id="scroll-target">
                <v-hover v-slot:default="{ hover }">
                  <v-card :elevation="hover ? 15 : 2"  class="scroll">
                    <v-responsive :aspect-ratio="16/9">
                      <v-img src="../images/sistema/fondo.jpg" >
                        <v-card-title class="title black--text">
                          {{item.Titulo}}
                        </v-card-title>
                            <v-card-subtitle class="pb-0">Lugar: {{item.Lugar}}</v-card-subtitle></b>
                              <v-card-subtitle class="pb-0">Categoria: {{item.Categoria}}</v-card-subtitle></b>
                              <v-card-text class="text--primary">
                                  <div>Caracteristicas Generales</div>
                                  <div>{{item.CaracteristicasGenerales}}</div>
                                </v-card-text>
                                <v-card-text class="text--primary">
                                    <div>Caracteristicas Especificas</div>
                                    <div>{{item.CaracteristicasEspecificas}}</div>
                                  </v-card-text>

                                  <b><v-card-subtitle color="white"class="pb-0">Fecha de Publicacion: {{item.FechaPublicacion}}
                                  </v-card-subtitle></b>

                                <b><v-card-subtitle color="white"class="pb-0">Contacto: {{item.CorreoElectronico}}
                                  </v-card-subtitle></b>
                                  <b><v-card-subtitle color="white"class="pb-0">Nombre: {{item.NombreCompleto}}
                                    </v-card-subtitle></b>
                                    <b><v-card-subtitle color="white"class="pb-0">Aprobado: {{item.Aprobado}}
                                      </v-card-subtitle></b>
                                      <b><v-card-subtitle color="white"class="pb-0">Estado: {{item.Estado}}
                                        </v-card-subtitle></b>
                                    <v-btn
                                      color="success"
                                      class="mr-4"
                                      @click="aprobarAnuncio(i)"
                                      name="btn6"
                                      required
                                    > Aprobar
                                  </v-btn>
                                  <v-btn
                                    color="success"
                                    class="mr-4"
                                    @click="rechazarAnuncio(i)"
                                    name="btn6"
                                    required
                                  > Rechazar
                                </v-btn>
                                <v-btn
                                  color="success"
                                  class="mr-4"
                                  @click="despublicarAnuncio(i)"
                                  name="btn6"
                                  required
                                > Despublicar
                              </v-btn>
                              <v-btn
                                color="success"
                                class="mr-4"
                                @click="republicarAnuncio(i)"
                                name="btn6"
                                required
                              > Republicar
                            </v-btn>
                                  <v-img :src="item.Imagen" >


                                  </v-img>


                      </v-img>
                    </v-responsive>

                  </v-card>
                </v-hover>
              </v-col>
            </div>
          </v-row>
        </v-container>

      </div>





    </div>
    <div v-else-if="mostrarInicio === 5 ">
      VERIFICAR HITOS
      <div >
        <center><v-toolbar-title> <h1>Hitos</h1> </v-toolbar-title></center>
        <v-btn
          color="blue"
          class="mr-4"
          @click="mostrarFiltrosHitos = !mostrarFiltrosHitos"
          name="btn6"
          required
        >  Mostrar Filtros
      </v-btn><br>

       <div v-if="mostrarFiltrosHitos">
        <v-toolbar-title > Filtros </v-toolbar-title>
        <v-combobox v-model="filtroHitoCategoria" :items="hitoItemsCategoria" label="Si quieres filtrar por categoria"
           ></v-combobox>
           <v-combobox v-model="filtroHitoPopularidad" :items="hitoItemsPopularidad" label="Si quieres filtrar por popularidad"
              ></v-combobox>
              <v-combobox v-model="filtroHitoAprobado" :items="hitoItemsAprobados" label="Si quieres filtrar por Aprobados"
                 ></v-combobox>
           <v-text-field
             v-model="filtroHitoUsuario"
             :counter="40"
             label="Si quieres filtrar por usuario"
             hint="Maximo 40 caracteres"
             counter
             required
           ></v-text-field>
           <div> Fecha Inicio</div>
           <v-date-picker
               label="Si quieres filtrar por fechas"
               v-model="filtroHitoInicioFecha"
               class="mt-4"
               min="1900-01-01"
               max="2040-01-01"
             ></v-date-picker>
             <div> Fecha Fin</div>
             <v-date-picker
                label="Si quieres filtrar por fechas"
                 v-model="filtroHitoFinFecha"
                 class="mt-4"
                 min="1900-01-01"
                 max="2040-01-01"
               ></v-date-picker><br><br>
               <v-btn
                 color="success"
                 class="mr-4"
                 @click="filtrarHitos()"
                 name="btn5"
                 required
               >  Filtrar Anuncios
             </v-btn>
             <v-btn
               color="success"
               class="mr-4"
               @click="reiniciarFiltrosHitos()"
               name="btn8"
               required
             >  Reiniciar Datos
           </v-btn>
           <v-btn
             color="success"
             class="mr-4"
             @click="reiniciarFechasHitos()"
             name="btn7"
             required
           >  Reiniciar Fechas
         </v-btn>
       </div>
        <v-container class="pa-4 text-center">
          <v-row class="fill-height" align="center" justify="center">
            <div v-for="(item, i) in hitosDashboard">
              <v-col :key="i" cols="20" md="8" id="scroll-target">
                <v-hover v-slot:default="{ hover }">
                  <v-card :elevation="hover ? 15 : 2"  class="scroll">
                    <v-responsive >
                      <v-img src="../images/sistema/fondo.jpg">
                        <v-card-title class="title black--text">
                          {{item.Titulo}}
                        </v-card-title>
                        <v-card-subtitle class="pb-0">Usuario: {{item.Usuario}}</v-card-subtitle></b>
                              <v-card-subtitle class="pb-0">Categoria: {{item.Categoria}}</v-card-subtitle></b>

                              <v-card-text class="text--primary">
                                  <div>Detalle del suceso:</div>
                                  <div>{{item.DetalleSuceso}}</div>
                                </v-card-text>
                                <v-card-text class="text--primary">
                                    <div>Comentario:</div>
                                    <div>{{item.Comentario}}</div>
                                  </v-card-text>

                                  <v-card-subtitle class="pb-0">Fecha del suceso: {{item.Fecha}}</v-card-subtitle></b>
                                  <v-card-subtitle class="pb-0">Fuente: {{item.Fuente}}</v-card-subtitle></b>
                                  <v-card-subtitle class="pb-0">Likes: {{item.Likes}}</v-card-subtitle></b>
                                    <v-card-subtitle class="pb-0">Dislikes: {{item.Dislikes}}</v-card-subtitle></b>


                                  <v-card-subtitle color="white"class="pb-0">Fecha de Publicacion: {{item.FechaPublicacion}}
                                  </v-card-subtitle></b>
                                  <v-card-subtitle color="white"class="pb-0">Ultima Fecha de Editado: {{item.Fecha_Editado}}
                                  </v-card-subtitle></b>
                                  <v-card-subtitle color="white"class="pb-0">Aprobado: {{item.Aprobado}}
                                  </v-card-subtitle></b>
                                  <v-card-subtitle color="white"class="pb-0">Estado: {{item.Estado}}
                                  </v-card-subtitle></b>
                                  <v-btn
                                    color="success"
                                    class="mr-4"
                                    @click="aprobarHito(i)"
                                    name="btn6"
                                    required
                                  > Aprobar
                                </v-btn>
                                <v-btn
                                  color="success"
                                  class="mr-4"
                                  @click="rechazarHito(i)"
                                  name="btn6"
                                  required
                                > Rechazar
                              </v-btn>
                              <v-btn
                                color="success"
                                class="mr-4"
                                @click="despublicarHito(i)"
                                name="btn6"
                                required
                              > Despublicar
                            </v-btn>
                            <v-btn
                              color="success"
                              class="mr-4"
                              @click="republicarHito(i)"
                              name="btn6"
                              required
                            > Republicar
                          </v-btn>


                                  <v-img :src="item.Imagen" >
                                  </v-img>
                                  <v-card-actions>
                                        <v-btn
                                          color="black"
                                          text
                                          @click="botonesMostrarComentarios[i].Mostrar = !botonesMostrarComentarios[i].Mostrar"
                                        >
                                          Mostrar Comentarios
                                        </v-btn>
                                      </v-card-actions>
                                  <div v-if="botonesMostrarComentarios[i].Mostrar">

                                  <v-card>
                                  <div v-for=" datos in comentariosHitos">
                                    <div v-if="datos[0].IdHito === hitosDashboard[i].Id">
                                      <div v-for="dato in datos">
                                        <v-list-item-avatar size="70px">
                                          <v-img :src="dato.ImagenPerfil" />
                                        </v-list-item-avatar>
                                        <v-card-subtitle color="white"class="pb-0">
                                          {{dato.Usuario}} comento:
                                        </v-card-subtitle>
                                        <v-card-subtitle color="white"class="pb-0"> {{dato.Comentario}}  </v-card-subtitle>
                                        <v-card-subtitle color="white"class="pb-0"> Fecha de Publicacion: {{dato.FechaPublicacion}}  </v-card-subtitle>

                                        <v-img :src="dato.Imagen" />
                                      </div>
                                    </div>

                                  </div>
                                </v-card>
                              </div>




                      </v-img>
                    </v-responsive>

                  </v-card>
                </v-hover>
              </v-col>
            </div>
          </v-row>
        </v-container>

      </div>
    </div>
    <div v-else-if="mostrarInicio === 6 ">
      VER USUARIOS
      <v-btn
        color="blue"
        class="mr-4"
        @click="mostrarFiltrosUsuario = !mostrarFiltrosUsuario"
        name="btn6"
        required
      >  Mostrar Filtros
    </v-btn><br>

     <div v-if="mostrarFiltrosUsuario">

      <v-toolbar-title > Filtros </v-toolbar-title>
      <v-combobox v-model="filtroUsuarioTipo" :items="itemsUsuarioTipo" label="Si quieres filtrar por tipo de usuario"
         ></v-combobox>
         <v-text-field
           v-model="filtroNombreUsuario"
           :counter="40"
           label="Si quieres filtrar por usuario"
           hint="Maximo 40 caracteres"
           counter
           required
         ></v-text-field>
         <div> Fecha Inicio</div>
         <v-date-picker
             label="Si quieres filtrar por fechas"
             v-model="filtroUsuarioInicioFecha"
             class="mt-4"
             min="1900-01-01"
             max="2040-01-01"
           ></v-date-picker>
           <div> Fecha Fin</div>
           <v-date-picker
              label="Si quieres filtrar por fechas"
               v-model="filtroUsuarioFinFecha"
               class="mt-4"
               min="1900-01-01"
               max="2040-01-01"
             ></v-date-picker><br><br>
             <v-btn
               color="success"
               class="mr-4"
               @click="filtrarUsuarios()"
               name="btn5"
               required
             >  Filtrar Anuncios
           </v-btn>
           <v-btn
             color="success"
             class="mr-4"
             @click="reiniciarUsuarioFechas()"
             name="btn6"
             required
           >  Reiniciar Fechas
         </v-btn>
       </div>
      <div>
      <v-container class="pa-4 text-center">
        <v-row class="fill-height" align="center" justify="center">
          <div v-for="(item, i) in usuariosSistema">
            <v-col :key="i" cols="20" md="8" id="scroll-target">
              <v-hover v-slot:default="{ hover }">
                <v-card :elevation="hover ? 15 : 2"  class="scroll">
                  <v-responsive :aspect-ratio="16/9">
                    <v-img src="../images/sistema/fondo.jpg" >
                      <v-card-title class="title black--text">
                        Usuario: {{item.Usuario}}
                      </v-card-title>
                          <v-card-subtitle class="pb-0">Nombre Completo: {{item.NombreCompleto}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">Fecha Nacimiento {{item.FechaNacimiento}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">Correo Electronico {{item.CorreoElectronico}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">Nivel Confianza {{item.NivelConfianza}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">Estado {{item.Estado}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">Tipo Usuario: {{item.TipoUsuario}}</v-card-subtitle></b>
                            <v-card-subtitle class="pb-0">1 = General, 2 = Administrador</v-card-subtitle></b>


                                  <v-btn
                                    color="success"
                                    class="mr-4"
                                    @click="habilitarUsuario(i)"
                                    name="btn6"
                                    required
                                  > Habilitar Usuario
                                </v-btn>
                                <v-btn
                                  color="success"
                                  class="mr-4"
                                  @click="deshabilitarUsuario(i)"
                                  name="btn6"
                                  required
                                > Deshabilitar Usuario
                              </v-btn>

                                <v-img :src="item.ImagenPerfil" >

                                </v-img>


                    </v-img>
                  </v-responsive>

                </v-card>
              </v-hover>
            </v-col>
          </div>
        </v-row>
      </v-container>


    </div>
    </div>
    <div v-else-if="mostrarInicio === 7" >
      <v-form
        ref="form2"
        v-model="valid9"
        lazy-validation
        method="post"
        action="crearUsuario.php"
      ><br>




      <center><v-toolbar-title center>Creacion de Usuario Administrador</v-toolbar-title></center>

      <v-text-field
        v-model="usuarioForm"
        :counter="30"
        :rules="usuarioFormRules"
        label="Usuario"
        hint="Maximo 30 caracteres"
        counter
        required
      ></v-text-field>

      <v-text-field
        v-model="contrasenaForm"
        :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
        :type="show2 ? 'text' : 'password'"
        :rules="contrasenaFormRules"
        label="Contrasena"
        @click:append="show2 = !show2"
        required
      ></v-text-field>

      <v-text-field
        v-model="contrasenaRepetidaForm"
        :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
        :type="show3 ? 'text' : 'password'"
        :rules="contrasenaRepetidaFormRules"
        label="Contrasena Repetida"
        @click:append="show3 = !show3"
        required
      ></v-text-field>

      <v-text-field
        v-model="nombreForm"
        :counter="30"
        :rules="nombreFormRules"
        label="Nombre Completo"
        hint="Maximo 40 caracteres"
        counter
        required
      ></v-text-field>

      <v-text-field
        v-model="correoElectronicoForm"
        :rules="correoFormRules"
        label="Correo Electronico"
        required
      ></v-text-field>



      <v-date-picker
          v-model="fechaForm"
          class="mt-4"
          min="1900-01-01"
          max="2040-01-01"
        ></v-date-picker>


<br><br>
      <v-btn
        :disabled="!valid2"
        color="success"
        class="mr-4"
        @click="registrarAdministrador()"
        name="btn2"
      >
        Registrarse
      </v-btn>
    </v-form>

    </div>
    <div v-else >
      SELECCIONA ALGUNA OPCION DEL MENU PARA VISUALIZARLA AQUI
    </div>
  </div>
</div>
</v-app>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="../js/administrador.js"> </script>
</body>
</html>
