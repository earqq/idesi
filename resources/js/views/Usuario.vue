<template>
    <div class="users_content">

        <div class="modal_content" v-if="flagModalUser">
          <div class="modal_wrapper">
            <div class="title"> 
              <h1> {{tipoAccion == 1 ? 'Crear' : 'Actualizar'}} Usuario </h1>
              <i  @click="closeModal()" class="material-icons-outlined">close</i>
            </div>
            <form>

                <div class="input_wrapper">
                    <label>Tipo documento</label>
                    <select v-model="tipo_documento">
                        <option value="DNI">DNI</option>
                        <option value="RUC">RUC</option>
                        <option value="CEDULA">CEDULA</option>
                        <option value="PASS">PASS</option>
                    </select>                                        
                </div>

                <div class="input_wrapper">
                    <label>Número documento</label>
                    <input type="email" v-model="num_documento">
                </div>

                <div class="input_wrapper">
                    <label>Nombre</label>
                    <input type="text" v-model="name" >                                        
                </div>
                
                
                <div class="input_wrapper">
                    <label>Dirección</label>
                    <input type="email" v-model="direccion">
                </div>

                <div class="input_wrapper">
                    <label>Teléfono</label>
                    <input type="email" v-model="telefono">
                </div> 

                <div class="input_wrapper">
                    <label>Email</label>
                    <input type="email" v-model="email">
                </div>

                <div class="input_wrapper">
                    <label>Role</label>
                    <select v-model="idrol" >
                        <option v-for="role in arrayRol" :key="role.id" :value="role.id" v-text="role.nombre"></option>
                    </select>
                </div>

                <div class="input_wrapper">
                    <label>Usuario</label>
                    <input type="text" v-model="usuario" >
                </div>

                <div class="input_wrapper">
                    <label>Contraseña</label>
                    <input type="password" v-model="password" >
                </div>

                <div v-show="errorPersona" class="form-group row div-error">
                    <div class="text-center text-error">
                        <div v-for="error in errorMostrarMsjPersona" :key="error" v-text="error">
                        </div>
                    </div>
                </div>

            </form>
            <button type="button" v-if="tipoAccion==1" class="button_primary medium" @click="registrarPersona()">
              <span>
              REGISTRAR
              </span>
            </button>
            <button type="button" v-if="tipoAccion==2" class="button_primary medium" @click="actualizarPersona()">
              <span>ACTUALIZAR</span> 
            </button>
          </div>
        </div>

        <div class="options_bar">
            <div class="search_bar">
            <i class="material-icons-outlined">search</i>
                <input type="text" placeholder="Buscar Usuario">
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
              <article class="user_card" v-for="persona in arrayPersona" :key="persona.id" >
                <div class="options">
                  <i class="material-icons-outlined" >more_horiz</i>
                  <ul>
                    <li @click="openEditModal(persona)">
                      Editar
                    </li>
                    <li v-if="persona.condicion" @click="desactivarUsuario(persona.id)">
                      Desactivar
                    </li>
                    <li v-else  @click="activarUsuario(persona.id)">
                      Activar
                    </li>
                  </ul>   
                </div>
                <div class="detail">
                  <div class="avatar">
                    <img src="https://picsum.photos/100/100" v-if="false"/>
                    <div class="avatar_alt" v-else>{{ persona.name.substring(0,1) }}</div>
                  </div>
                  <p class="card-document">{{persona.name}}</p>
                  <small class="card-name" >{{persona.rol}}</small>
                </div>
              </article>
              <a v-show="arrayPersona.length < 6" class="spanner" v-for="i in 6" :key="i*1.3"  >
              </a>
            </div>

            <div class="table_wrapper" v-else>
                <table class="table_clients">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Número</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            <th>Usuario</th>
                            <th>Role</th>
                            <th class="options">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="persona in arrayPersona" :key="persona.id">
                            <td v-text="persona.name"></td>
                            <td v-text="persona.num_documento"></td>
                            <td v-text="persona.telefono"></td>
                            <td v-text="persona.email"></td>
                            <td v-text="persona.usuario"></td>
                            <td v-text="persona.rol"></td>
                            <td class="options">
                              <i class="material-icons-outlined" >more_horiz</i>
                              <ul>
                                <li @click="openEditModal(persona)">
                                  Editar
                                </li>
                                <li v-if="persona.condicion" @click="desactivarUsuario(persona.id)">
                                  Desactivar
                                </li>
                                <li v-else  @click="activarUsuario(persona.id)">
                                  Activar
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
    export default {
        data (){
            return {
                flagModalUser: false, 
                persona_id: 0,
                name : '',
                tipo_documento : '',
                num_documento : '',
                direccion : '',
                telefono : '',
                email : '',
                usuario: '',
                password:'',
                idrol: '',
                arrayPersona : [],
                arrayRol : [],
                modal : 0,
                tituloModal : '',
                tipoAccion : 1,
                errorPersona : 0,
                errorMostrarMsjPersona : [],
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 3,
                criterio : 'name',
                buscar : '',
                loading: true,
                loaderCargaPagina: 0,
                notificationSystem: {
                    options: {
                        success: {
                            position: "topRight"
                        },
                        error: {
                            position: "topRight"
                        }
                    }
                },
                type_list: 1

            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginación
            pagesNumber: function() {
                if(!this.pagination.to) {
                    return [];
                }
                
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  

                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;             

            }
        }, 
        methods : {
            listarPersona (page,buscar,criterio){
                let me=this;
                var url=  '/user?page=' + page + '&buscar='+ buscar + '&criterio='+ criterio;
                axios.get(url).then(function (response) {
                    var respuesta= response.data;
                    me.arrayPersona = respuesta.personas.data;
                    me.pagination= respuesta.pagination;
                    me.loaderCargaPagina =1;
                    me.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            selectRol(){
                let me=this;
                var url= '/rol/selectRol';
                axios.get(url).then(function (response) {
                    //console.log(response);
                    var respuesta= response.data;
                    me.arrayRol = respuesta.roles;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },

            cambiarPagina(page,buscar,criterio){
                let me = this;
                //Actualiza la página actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar la data de esa página
                me.listarPersona(page,buscar,criterio);
            },
            registrarPersona (){
                if (this.validarPersona()){
                    return;
                }
                axios.post('/user/registrar',{
                    'name': this.name,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'idrol' : this.idrol,
                    'usuario': this.usuario,
                    'password': this.password

                }).then( response => {
                    this.flagModalUser = false
                    this.listarPersona(1,'','name');
                }).catch( error => {
                    console.log(error);
                })
            },
            actualizarPersona(){
               if (this.validarPersona()){
                    return;
                }
                axios.put('/user/actualizar',{
                    'name': this.name,
                    'tipo_documento': this.tipo_documento,
                    'num_documento' : this.num_documento,
                    'direccion' : this.direccion,
                    'telefono' : this.telefono,
                    'email' : this.email,
                    'idrol' : this.idrol,
                    'usuario': this.usuario,
                    'password': this.password,
                    'id': this.persona_id
                }).then( response => {
                    this.flagModalUser = false
                    this.listarPersona(1,'','name');
                }).catch( error => {
                    console.log(error);
                }); 
            },
            validarPersona(){
                this.errorPersona=0;
                this.errorMostrarMsjPersona =[];

                if (!this.name) this.errorMostrarMsjPersona.push("El nombre de la pesona no puede estar vacío.");
                if (!this.usuario) this.errorMostrarMsjPersona.push("El nombre de usuario no puede estar vacío.");
                if (!this.password) this.errorMostrarMsjPersona.push("La password del usuario no puede estar vacía.");
                if (this.idrol==0) this.errorMostrarMsjPersona.push("Seleccione una Role.");
                if (this.errorMostrarMsjPersona.length) this.errorPersona = 1;

                return this.errorPersona;
            },
            closeModal(){
                this.flagModalUser = false
                this.modal=0
                this.tituloModal=''
                this.name=''
                this.tipo_documento='DNI'
                this.num_documento=''
                this.direccion=''
                this.telefono=''
                this.email=''
                this.usuario=''
                this.password=''
                this.idrol=0
                this.errorPersona=0
            },
            openEditModal (data) {
              this.tipoAccion = 2
              this.flagModalUser = true
              this.persona_id=data['id']
              this.name = data['name']
              this.tipo_documento = data['tipo_documento']
              this.num_documento = data['num_documento']
              this.direccion = data['direccion']
              this.telefono = data['telefono']
              this.email = data['email']
              this.usuario = data['usuario']
              this.password=data['password']
              this.idrol=data['idrol']
            },
            openModal(){
              this.tipoAccion = 1
              this.flagModalUser = true
              this.name= ''
              this.tipo_documento='DNI'
              this.num_documento=''
              this.direccion=''
              this.telefono=''
              this.email=''
              this.usuario=''
              this.password=''
              this.idrol=0
                // this.selectRol();
            },
            desactivarUsuario(id){
               const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de desactivar usuario?',
                    // text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        
                        let me = this;

                            axios.put( '/user/desactivar',{
                                'id': id
                            }).then(function (response) {
                                me.listarPersona(1,'','name');
                                this.$toast.success(
                                    "El usuario fue desactivado",
                                    "Exitoso",
                                    this.notificationSystem.options.success
                                    ); 
                            }).catch(function (error) {
                                console.log(error);
                            });
                        
                    } else if (
                        // Read more about handling dismissals
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El registro no fue desactivado',
                        'error'
                        )
                    }
                    })
            },
            activarUsuario(id){
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                    },
                    buttonsStyling: false,
                    })

                    swalWithBootstrapButtons.fire({
                    title: 'Esta seguro de activar usuario?',
                    // text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Aceptar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        
                       let me = this;

                                axios.put('/user/activar',{
                                    'id': id
                                }).then(function (response) {
                                    me.listarPersona(1,'','name');
                                    this.$toast.success(
                                        "El usuario fue activado",
                                        "Exitoso",
                                        this.notificationSystem.options.success
                                        ); 
                                }).catch(function (error) {
                                    console.log(error);
                                });
                        
                    } else if (
                        result.dismiss === Swal.DismissReason.cancel
                    ) {
                        swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El registro no fue desactivado',
                        'error'
                        )
                    }
                    })
            },
        },
        mounted() {
            this.listarPersona(1,this.buscar,this.criterio);
            this.selectRol();
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
            border-radius: 3px
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
</style>