<template>
    <div class="users_content">

        <div class="modal_content" v-if="flagModalUser">
          <div class="modal_wrapper">
            <div class="title"> 
              <h1> {{user.id == 0 ? 'Crear' : 'Actualizar'}} Usuario </h1>
              <i  @click="flagModalUser = false" class="material-icons-outlined">close</i>
            </div>
            <form>

                <div class="input_wrapper" :class="{require: user.name.length<4}">
                    <label>Nombre</label>
                    <input type="text" v-model="user.name" >                                        
                </div>
                
                <div class="input_wrapper">
                    <label>Nivel</label>
                    <select v-model="user.nivel" >
                        <option value="2" v-if="evaluador_final==0">Evaluador Final</option>
                        <option value="3">Evaluador</option>
                        <option value="4">Analista</option>
                        <option value="5">Plataforma</option> 
                    </select>
                </div>

                <div class="input_wrapper" :class="{require: user.usuario.length<4}">
                    <label>Usuario</label>
                    <input type="text" v-model="user.usuario" >
                </div>

                <div class="input_wrapper" :class="{require: !validateUserPassword}">
                    <label>Contraseña</label>
                    <input type="text" v-model="user.password" >
                </div>
            </form>
            <button type="button" v-if='validateUser' class="button_primary medium" :class="{loading: loading}" @click="registerUser()">
              <span v-if='user.id==0'>
              REGISTRAR
              </span>
              <span v-else>
                ACTUALIZAR
              </span>
              <div class="load_spinner"></div>
            </button>            
          </div>
        </div>

        <div class="options_bar">
            <div class="search_bar">
            <i class="material-icons-outlined">search</i>
                <input type="text" v-model='search.text' @keyup='getUsers()' placeholder="Buscar Usuario">
            </div>
            <div class="switch_view">
            <a @click="type_list = 1" :class="{selected: type_list == 1}">
                <i class="material-icons-outlined">border_all</i>
            </a>
            <a @click="type_list = 0" :class="{selected: type_list == 0}">
                <i class="material-icons-outlined">notes</i>
            </a>
            </div>
    
            <a class="add_client button_primary medium" @click="openModal()">
                <span>
                    NUEVO USUARIO 
                </span>
                <i class="material-icons-outlined">add</i>
            </a>
        </div>

        <div class="table_container">
            <div class="table_grid"  v-if="type_list=='1'">
              <article class="user_card" v-for="user in users" :key="user.id" >
                <div  class="options">
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul v-if='user.nivel>2' >
                    <li  @click="openEditModal(user)">
                      Editar
                    </li>                     
                  </ul>   
                </div>
                <div class="detail">
                  <div class="avatar">
                    <img src="https://picsum.photos/100/100" v-if="false"/>
                    <div class="avatar_alt" v-else>{{ user.name.substring(0,1) }}</div>
                  </div>
                  <div class="name_wrapper">
                    <p class="truncate">{{user.name}}</p>
                    <small class="truncate" >{{levels[user.nivel]}}</small>
                  </div>
                </div>
              </article>
              <a v-show="users.length < 6" class="spanner" v-for="i in 6" :key="i*1.3"  >
              </a>
            </div>

            <div class="table_wrapper" v-else>
                <table class="table_clients">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Usuario</th>
                            <th>Nivel</th>
                            <th class="options">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="user in users" :key="user.id">
                            <td v-text="user.name"></td>
                            <td v-text="user.usuario"></td>
                            <td v-text="levels[user.nivel]"></td>
                            <td class="options">
                              <i class="material-icons-outlined" >more_horiz</i>
                              <ul  v-if='user.nivel>2'>
                                <li @click="openEditModal(user)">
                                  Editar
                                </li>                              
                              </ul>
                            </td>
                        </tr>                                
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</template>

<script>
 import { toastOptions } from '../constants.js'
    export default {
        data (){
            return {
                flagModalUser: false, 
                user:{
                  name : '',
                  usuario: '',
                  password:'',
                  nivel: '1',
                  id:0 
                },
                users : [],
                evaluador_final: 0,
                loading: false,               
                type_list: 1,
                search:{
                  text:''
                },
                levels:{
                  '1' : 'Administrador',
                  '2' : 'Evaluador final',
                  '3' : 'Evaluador',
                  '4' : 'Analista',
                  '5' : 'Plataforma',
                }
            }
        },
        methods : {
            getUsers (){
                var url=  '/user?buscar='+ this.search.text 
                axios.get(url).then(res => {
                    this.users = res.data.users.data; 
                    this.evaluador_final = res.data.evaluador_final;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },          
            registerUser (){
                this.loading=true
                axios.post('/user',
                  this.user
                ).then( response => {
                    this.flagModalUser = false
                    this.loading=false
                    this.getUsers();
                    this.$toast.success(
                        "El usuario fue creado",
                        'Exitoso',
                        toastOptions.success
                    )
                }).catch( error => {
                    console.log(error);
                    this.$toast.success(
                        "Error al crear usuario ",
                        'Fallo',
                        toastOptions.error
                    )
                })
            },        
            openEditModal (data) {
              this.flagModalUser = true
              this.user.id = data['id']
              this.user.name = data['name']
              this.user.usuario = data['usuario']
              this.user.nivel=data['nivel']
            },
            openModal(){
              this.flagModalUser = true
              this.user.name= ''
              this.user.id= 0
              this.user.usuario=''
              this.user.password=''
              this.user.nivel=4
            },
        },
        computed:{
          validateUserName(){
            return this.user.name.length>3
          },
          validateUserUsuario(){
            return this.user.usuario.length>3
          },
          validateUserPassword(){
            if(this.user.id==0)
              return this.user.password.length>3
            else return true
          },
          validateUser(){
            if(this.validateUserName && 
                this.validateUserUsuario &&
                this.validateUserPassword
              )
                return true
              else
                return false
          }
        },
        mounted() {
            this.getUsers();
        }
    }
</script>

<style lang="sass">
@import "../../sass/variables"
.users_content
    .options_bar
        display: grid
        grid-template-columns: 1fr 120px 200px
        grid-gap: 15px
        padding: 20px
        box-sizing: border-box 
        .add_client
            width: 200px
        .search_bar
            border-radius: 4px
            overflow: hidden
            background-color: white
            box-shadow: $shadow
            flex: 1
            height: 40px
            display: flex
            align-items: center
            padding: 0 15px
            border: 1px solid $line_color
            i
                font-size: 20px
            input, select
                border: none
                font-family: $font
                height: 100%
                font-size: 13px
                background-color: white
                &:hover, &:focus
                    outline: none
            input
                flex: 1
                padding-left: 10px
            select
                border-left: 1px solid $line_color
                padding: 0 15px
                box-sizing: border-box
        .switch_view
            border-radius: 3px
            background-color: white
            box-shadow: $shadow
            flex: 1
            height: 40px
            display: flex
            border: 1px solid $line_color
            a
                height: 100%
                flex: 1
                flex-basis: 0
                display: flex
                justify-content: center
                align-items: center
                cursor: pointer
                color: rgba($text_color, .3)
                user-select: none
                &.selected
                    i
                        color: $primary_color
                i
                    font-size: 20px
                &:first-child
                    border-right: 1px solid $line_color
    .table_container
      .table_grid
        display: grid
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr) )
        grid-gap: 15px
        padding: 0 20px
        box-sizing: border-box
        .user_card
          background-color: white
          border-radius: 4px
          box-shadow: $shadow
          box-sizing: border-box
          transition: all ease-in-out .3s
          border: 1px solid $line_color
          .options
            display: flex
            align-items: center
            justify-content: center
            width: 40px
            height: 27px
            cursor: pointer
            position: relative
            float: right
            &:hover
              i
                opacity: 1
              ul
                display: block
            i
              cursor: pointer
              opacity: .5
              color: $text_color
              user-select: none
            ul
              position: absolute
              background-color: #fff
              box-shadow: $shadow_hover
              border-radius: 4px
              top: 30px
              right: 6px
              font-size: 12px
              z-index: 4
              width: 140px
              transition: opacity ease 200ms
              padding: 10px 0
              display: none
              border: 1px solid $line_color
              &::before
                position: absolute
                display: block
                content: ''
                width: 12px
                height: 12px
                background-color: white
                top: -7px
                right: 7px
                transform: rotateZ(45deg)
                border-top: 1px solid #f3f1f1
                border-left: 1px solid #f3f1f1
              li
                height: 35px
                line-height: 38px
                cursor: pointer
                text-align: left
                padding-left: 20px
                color: $primary_color
                list-style: none
                color: black
                &:hover
                    background-color: $bg_color
                a
                  text-decoration: none
                  color: $primary_color
                  height: 100%
                  width: 100%
                  display: block
                  text-decoration: none
                  color: black
          &:hover
            box-shadow: $shadow_hover
          .detail
            display: flex
            flex-direction: column
            align-items: center
            justify-content: center
            padding: 40px 20px
            width: 100%
            .avatar
              .avatar_alt
                width: 55px
                height: 55px
                background-color: $line_color
                border-radius: 50%
                display: flex
                align-items: center
                justify-content: center
                font-size: 17px
                font-weight: 600
                color: $primary_color
              img
                width: 55px
                height: 55px
                border-radius: 50%
                object-fit: cover
            .name_wrapper
              text-align: center
              p, small
                color: $text_color
                margin: 0
              p
                font-weight: 500
                font-size: 12px
                margin-top: 10px
                text-align: center
                line-height: 1.3
              small
                font-size: 11px
                display: block
      .table_wrapper
        padding: 0 20px
        box-sizing: border-box
        .table_clients
          box-shadow: $shadow
          border: 1px solid $line_color
          tbody
            .client
              .avatar
                .avatar_alt
                  width: 30px
                  height: 30px
                  background-color: $line_color
                  border-radius: 50%
                  display: flex
                  align-items: center
                  justify-content: center
                  font-size: 13px
                  font-weight: 600
                  color: $primary_color
                img
                  width: 30px
                  height: 30px
                  border-radius: 50%
                  object-fit: cover
              p
                margin: 0
                margin-left: 10px
                text-align: left

@media screen and (max-width: 1000px)
  .users_content
    .options_bar
      grid-template-columns: 1fr 170px
      .add_client
        width: 170px
      .switch_view
        display: none

@media screen and (max-width: 720px)
  .users_content
    .options_bar
      grid-template-columns: 1fr 40px
      .add_client
        width: 40px
        span
          display: none
      .switch_view
        display: none

@media screen and (max-width: 500px)
  .users_content
    .options_bar
      grid-template-columns: 1fr
      padding: 0
      padding-bottom: 15px
      position: sticky
      top: 55px
      z-index: 7
      .search_bar
        padding: 0
        padding-left: 10px
        border-radius: 0
        border: none
        border-bottom: 1px solid $line_color
        height: 50px
        select
          padding: 0 5px
      .add_client
        width: 50px
        height: 50px
        position: fixed
        bottom: 15px
        right: 15px
    .table_container
      .table_grid
        grid-gap: 10px
        padding: 0 15px
        .user_card
          .detail
            flex-direction: row
            padding: 20px 15px
            justify-content: flex-start
            padding-top: 0
            .avatar
              margin-right: 10px
              .avatar_alt
                width: 40px
                height: 40px
                font-size: 15px
              img
                width: 40px
                height: 40px
            .name_wrapper
              text-align: left
              p
                margin-top: 0
                text-align: left        
</style>