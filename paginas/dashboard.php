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
  <div id="app">

    <v-app>


      <v-toolbar dark prominent src="https://cdn.vuetifyjs.com/images/backgrounds/vbanner.jpg">


        <v-spacer></v-spacer>




        </v-app-bar-nav-icon>
        <v-spacer></v-spacer>

        <v-app-bar-nav-icon>
          <v-btn @click="mostrarInicio = 3">
            Dashboard

          </v-btn>



        </v-app-bar-nav-icon>

        <v-spacer></v-spacer>

        <v-app-bar-nav-icon>
          <v-btn @click="verPublicaciones()">
            Informacion General
          </v-btn>



        </v-app-bar-nav-icon>
        <v-spacer></v-spacer>




        <v-app-bar-nav-icon>

          <v-btn @click="redireccionarLogin()">
            Inicia Sesion
          </v-btn>

        </v-app-bar-nav-icon>


        <v-toolbar-title> {{usuario}} </v-toolbar-title>

        <v-spacer></v-spacer>

        <v-btn icon>
          <v-icon>mdi-export</v-icon>
        </v-btn>
      </v-toolbar>
        <!-- {%FOOTER_LINK}
      <div v-if="mostrarInicio === 2">


        <v-img src="../images/sistema/desenfocado2.jpeg" >
          <center><v-toolbar-title> Imagen de Perfil </v-toolbar-title></center>

        <center><v-card width="300" height="300">
        <v-avatar
            class="profile"
            color="grey"
            size="300"
            tile
          >
          <v-img :src="`${perfilImagen}`" />
          </v-avatar>
        </v-card></center>

        <v-file-input type="file" id="file" ref="file" label="Selecciona tu imagen" prepend-icon="mdi-camera"
          v-model="foto"> </v-file-input>
          <v-btn type="button" @click='uploadFile' x-large color="success" dark> Subir Imagen de Perfil</v-btn>
          <br><br><br>
          <v-btn type="button" @click='verAnuncios()' x-large color="black" dark> Ver Mis Anuncios</v-btn>
          <v-btn type="button" @click='verHitos()' x-large color="brown" dark> Ver Mis Hitos </v-btn>
          <v-btn type="button" @click='verPublicacion = 0' x-large color="grey" dark> Ocultar Publicaciones </v-btn>

          <div v-if="verPublicacion === 1">

            <div >
              <center><v-toolbar-title> <h1>Mis Anuncios</h1> </v-toolbar-title></center>

              <v-container class="pa-4 text-center">
                <v-row class="fill-height" align="center" justify="center">
                  <div v-for="(item, i) in anunciosArreglo">
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


                                        <v-card-subtitle color="white"class="pb-0">Aprobado: {{item.Aprobado}}
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">0=NO, 1= SI,
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">Estado: {{item.Estado}}
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">0=DESPUBLICADO, 1= PUBLICADO
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">Fecha de Publicacion: {{item.FechaPublicacion}}
                                        </v-card-subtitle></b>

                                        <v-card-actions>
                                              <v-btn
                                                color="black"
                                                text
                                              >
                                                Despublicar Anuncio
                                              </v-btn>
                                            </v-card-actions>

                                        <v-img :src="item.Imagen" height="1000px">


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

          <div v-else-if=" verPublicacion === 2">
            <div >
              <center><v-toolbar-title> <h1>Mis Hitos</h1> </v-toolbar-title></center>
              <v-container class="pa-4 text-center">
                <v-row class="fill-height" align="center" justify="center">
                  <div v-for="(item, i) in hitosArreglo">
                    <v-col :key="i" cols="20" md="8" id="scroll-target">
                      <v-hover v-slot:default="{ hover }">
                        <v-card :elevation="hover ? 15 : 2"  class="scroll">
                          <v-responsive :aspect-ratio="16/9">
                            <v-img src="../images/sistema/fondo.jpg">
                              <v-card-title class="title black--text">
                                {{item.Titulo}}
                              </v-card-title>
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
                                       <v-card-subtitle color="white"class="pb-0">0=NO, 1= SI,
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">Estado: {{item.Estado}}
                                        </v-card-subtitle></b>
                                        <v-card-subtitle color="white"class="pb-0">0=DESPUBLICADO, 1= PUBLICADO
                                        </v-card-subtitle></b>

                                        <v-card-actions>
                                              <v-btn
                                                color="black"
                                                text
                                              >
                                                Despublicar Hito
                                              </v-btn>
                                            </v-card-actions>
                                            <v-card>
                                        <v-img :src="item.Imagen" >

                                        </v-img>
                                      </v-card>




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

          <div v-else>
            c
          </div>





      </div> -->
      <div v-if="mostrarInicio === 3">
        <v-img src="../images/sistema/desenfocado3.jpeg" >

        <v-btn type="button" @click='verDashboardAnuncios()' x-large color="black" dark> Ver Anuncios Generales</v-btn>
        <v-btn type="button" @click='verDashboardHitos()' x-large color="brown" dark> Ver  Hitos Generales </v-btn>
        <v-btn type="button" @click='verAnalisisDatos()' x-large color="grey" dark> Ir al Analisis de Datos Covid-19 </v-btn>

        <div v-if="mostrarDashboard === 1">
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

        </v-img>
        </div>

        <div v-else-if="mostrarDashboard === 2">

          <div >
            <center><v-toolbar-title> <h1>Hitos de la comunidad</h1> </v-toolbar-title></center>
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
                                      <!--
                                      <v-card-actions>
                                            <v-btn
                                              color="black"
                                              text
                                              @click="interaccionHito(i, 1)"
                                            >
                                              Like
                                            </v-btn>
                                          </v-card-actions>
                                          <v-card-actions>
                                                <v-btn
                                                  color="black"
                                                  text
                                                  @click="interaccionHito(i, 2)"
                                                >
                                                  Dislike
                                                </v-btn>
                                              </v-card-actions>

                                              <v-file-input type="file" id="file3" ref="file3" label="Selecciona tu imagen" prepend-icon="mdi-camera"
                                                v-model="escribirComentarioHitos[i].Imagen" placeholder="Extensiones validas: jpg, jpeg, png y pdf"> </v-file-input>
                                              <v-textarea
                                                          v-model="escribirComentarioHitos[i].Comentario"
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
                                                          :rules="hitoDetalleRules"
                                                          required
                                                        ></v-textarea>
                                                        <v-card-actions>
                                                              <v-btn
                                                                color="black"
                                                                text
                                                                @click="crearComentario(i)"
                                                              >
                                                                Comentar
                                                              </v-btn>
                                                            </v-card-actions>
                                                          -->
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

        <div v-else-if="mostrarDashboard === 3">

        </div>

        <div v-else>

        </div>






      </div>
      <div v-else-if="mostrarInicio === 4">
        <div>
        <center><v-toolbar-title > {{imagenesInfoGeneral[carrousel].Titulo}} </v-toolbar-title>
        <v-card-subtitle class="pb-0">  {{imagenesInfoGeneral[carrousel].Comentario}}</v-card-subtitle></b>
        <v-card-subtitle class="pb-0"> Categoria: {{imagenesInfoGeneral[carrousel].Categoria}}</v-card-subtitle></b>
        <v-card-subtitle class="pb-0"> Fecha de Publicacion: {{imagenesInfoGeneral[carrousel].FechaPublicacion}}</v-card-subtitle></b></center>

        <v-carousel  cycle interval="6000"  height="auto" v-model="carrousel">
          <div >
          <center><v-carousel-item
          v-for="(item,i) in imagenesInfoGeneral"
          :key="i"
          :src="item.Imagen"
             style="width:70%;height:40%;" :alt="item.Imagen"
          >
          </v-carousel-item></center>

        </div>
      </v-carousel>

      </div>
      </div>

        <!--
      <div v-else-if="mostrar === 5">
        <div>
        <v-form
          ref="form2"
          v-model="valid4"
          lazy-validation
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
                      label="Detalle"
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

                    <v-file-input type="file" id="file3" ref="file3" label="Selecciona tu imagen" prepend-icon="mdi-camera"
                      v-model="foto3" placeholder="Extensiones validas: jpg, jpeg, png y pdf"> </v-file-input>

                    <v-date-picker
                        v-model="hitoFecha"
                        class="mt-4"
                        min="1900-01-01"
                        max="2040-01-01"
                      ></v-date-picker><br><br>

                      <v-btn
                        :disabled="!valid4"
                        color="success"
                        class="mr-4"
                        @click="registrarHito()"
                        name="btn3"
                        required
                      >  Registrar Anuncio
                    </v-btn>
                      <br><br>
        </v-form>
      </div>
      </div>
      <div v-else-if="mostrar === 6">
        <div>
        <v-form ref="form2" v-model="valid2" lazy-validation method="post"><br>


          <center>
            <v-toolbar-title center>CREACION DE ANUNCIO</v-toolbar-title>
          </center>

          <v-text-field v-model="titulo" :counter="40" :rules="tituloRules" label="Titulo del anuncio"
            hint="Maximo 40 caracteres" counter required></v-text-field>

          <v-combobox v-model="categoria" :items="itemsCategoria" label="Selecciona la categoria del anuncio"
            value="Vehiculos" required></v-combobox>

          <v-textarea v-model="caracGenerales" :auto-grow="autoGrow" :clearable="clearable"
            :counter="counter ? counter : false" :filled="filled" :flat="flat" :hint="hint" :label="label"
            :loading="loading" :no-resize="noResize" :outlined="outlined" :persistent-hint="persistentHint"
            :placeholder="placeholder" :rounded="rounded" :row-height="rowHeight" :rows="rows" :shaped="shaped"
            :single-line="singleLine" :solo="solo" label="Caracteristicas Generales" counter hint="Maximo 200 caracteres"
            :rules="caracGeneralesRules" required></v-textarea>

          <v-textarea v-model="caracEspecificas" :auto-grow="autoGrow" :clearable="clearable"
            :counter="counter ? counter : false" :filled="filled" :flat="flat" :hint="hint" :label="label"
            :loading="loading" :no-resize="noResize" :outlined="outlined" :persistent-hint="persistentHint"
            :placeholder="placeholder" :rounded="rounded" :row-height="rowHeight" :rows="rows" :shaped="shaped"
            :single-line="singleLine" :solo="solo" label="Caracteristicas Especificas" counter hint="Maximo 200 caracteres"
            :rules="caracEspecificasRules" required></v-textarea>


          <v-text-field v-model="lugar" :counter="50" :rules="lugarRules" label="Lugar donde aplica el anuncio"
            hint="Maximo 50 caracteres" counter required></v-text-field>

            <v-file-input type="file" id="file2" ref="file2" label="Selecciona tu imagen" prepend-icon="mdi-camera"
              v-model="foto2" placeholder="Extensiones validas: jpg, jpeg, png y pdf"> </v-file-input>

          <v-btn :disabled="!valid2" color="success" class="mr-4" @click="registrarAnuncio()" name="btn2" required>
            Registrar Anuncio
          </v-btn>


          <br><br>

        </v-form>
      </div>

    </div>-->
      <div v-else>
        Si no es A, B o C
      </div>




    </div>







  </v-app>
  </div>




  <script src="https://cdn.jsdelivr.net/npm/vue@2.x/dist/vue.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vuetify@2.x/dist/vuetify.js"></script>
  <script src="../js/usuario.js"> </script>
</body>

</html>
