<template>
    <div class="dashboard_content">
        <div class="dashboard_wrapper">
            <article class="numbers_stats">
                <div class="number_item n1">
                    <i class="material-icons-outlined"> sort </i>
                    <div class="stat">
                        <h1 v-text="prestamo_total"></h1>
                        <p>Prestamos Totales</p>
                    </div>
                </div>
                <div class="number_item n2">
                    <i class="material-icons-outlined"> access_time </i>
                    <div class="stat">
                        <h1 v-text="prestamo_prendiente"></h1>
                        <p>Prestamos Pendientes</p>
                    </div>
                </div>
                <div class="number_item n3">
                    <i class="material-icons-outlined"> shuffle </i>
                    <div class="stat">
                        <h1 v-text="prestamo_rechazado"></h1>
                        <p>Prestamos Rechazados</p>
                    </div>
                </div>
                <div class="number_item n1">
                    <i class="material-icons-outlined"> playlist_add_check </i>
                    <div class="stat">
                        <h1 v-text="prestamo_aprobado"></h1>
                        <p>Prestamos Aprobados</p>
                    </div>
                </div>
                <div class="number_item n2">
                    <i class="material-icons-outlined"> swap_horiz </i>
                    <div class="stat">
                        <h1 v-text="prestamo_proceso"></h1>
                        <p>Prestamos en Procesos</p>
                    </div>
                </div>
                <div class="number_item n3">
                    <i class="material-icons-outlined"> error_outline </i>
                    <div class="stat">
                        <h1 v-text="prestamo_observado"></h1>
                        <p>Prestamos Observados</p>
                    </div>
                </div>
            </article>
            <article class="chart_stats" >
                <h2 class="title"> Historial / A??o </h2>
                <div id="chart">
                    <apexchart type="line" height="350" :options="optionsChart" :series="series" />
                </div>
            </article>
            <article class="lists">
                <div class="list_client">
                    <div class="empty_message" v-if="clientes.length==0">
                        <img src="img/empty.svg" >
                        <h1> No Se Encontraron Clientes </h1>
                        <p>Registra un nuevo cliente para continuar.</p>
                    </div>
                    <h2 class="title" v-if="!clientes.length==0"> Nuevos Clientes </h2>
                    
                    <ul class="list_client_wrapper" v-if="!clientes.length==0">
                        <li v-for="cliente in clientes" :key="cliente.id" @click="goToClient(cliente)">
                            <div class="avatar">
                                <div class="request" v-show="cliente.estado=='0'">
                                    <i class="material-icons-outlined">email</i>
                                </div>
                                <img src="https://picsum.photos/200/300" v-if="false"/> 
                                <div class="avatar_alt" :class="{denied : cliente.estado=='3'}"  >{{ cliente.persona ? cliente.persona.nombres.substring(0,1) : cliente.empresa.razon_social.substring(0,1) }}</div>
                            </div>
                            <div class="name">
                                <h1 class="truncate" v-text="cliente.persona.nombres+' '+cliente.persona.apellidos"> </h1>
                                <p v-text="cliente.documento"></p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="list_credits">
                    
                    <div class="empty_message" v-if="prestamos.length<=0">
                        <img src="img/empty_2.svg" >
                        <h1> No Se Encontraron Prestamos  </h1>
                        <p>Registra un nuevo cliente para crear prestamos.</p>
                    </div>
                    <h2 class="title" v-if="prestamos.length>0"> Prestamos Pendientes </h2>
                    <div class="table_wrapper " v-if="prestamos.length>0">
                        <table class="table_credits no_hover">
                            <thead>
                                <tr>
                                    <th>Cliente</th>
                                    <th>Producto</th>
                                    <th>aporte</th>
                                    <th>importe</th>
                                    <th>cuotas</th>
                                    <!-- <th>Progreso</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(prestamo,index) in prestamos" :key="index">
                                    <td class="client">
                                        
                                        <div class="name_wrapper">
                                            <p class="truncate"> {{prestamo.cliente.persona.nombres}} {{prestamo.cliente.persona.apellidos}} </p>
                                            <small class="credit_detail">
                                                {{prestamo.producto}}
                                            </small>
                                        </div>
                                    </td>
                                    <td> {{prestamo.producto}}</td>
                                    <td> S/. {{prestamo.aporte}}</td>
                                    <td> S/. {{prestamo.importe}}</td>
                                    <td> {{prestamo.cuotas}} </td>
                                    <!-- <td> 
                                        <div class="progress_bar">
                                        <span class="bar"></span>
                                        <p>0% </p>
                                        </div> 
                                    </td> -->
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </article>
            <aside class="map">
                <GmapMap :center="{lat: -9.933378, lng: -76.243212}" :zoom="16" :clickable="true" map-type-id="roadmap" style="width: 100%; height: calc(100vh - 51px);" :options="optionsMap" ref="mapRef">
                </GmapMap>
            </aside>
        </div>
    </div>
</template>

<script>
import { STYLES_MAP } from '../constants'
export default {
    data () {
        return {
                  currentUser:{
                id:0,
                nivel:1,        
            },
            clientes: [],
            prestamos:[],
            cliente: 0,
            prestamo_rechazado: 0,
            prestamo_total: 0,
            prestamo_prendiente: 0,
            prestamo_aprobado:0,
            prestamo_proceso:0,
            prestamo_observado:0,
            optionsMap: {
                styles: STYLES_MAP,
                zoomControl: false,
                mapTypeControl: false,
                scaleControl: false,
                streetViewControl: false,
                rotateControl: false,
                fullscreenControl: false,
            },
            optionsChart: {
                chart: {
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    }
                },
                stroke: {
                    colors: ["#0061FE", "#FF003D", "#FF8A00"],
                    width: 1.7,
                    curve: 'smooth'
                },
                dataLabels: {
                    enabled: false
                },
                colors: ["#0061FE", "#FF003D", "#FF8A00"],
                xaxis: {
                    categories: ['Ene', 'Feb', 'Mar', 'Abr','May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic']
                },
                yaxis: {
                    labels: {
                        formatter: function (value) {
                        return `${Number(value)}`
                        }
                    }
                },
                markers: {
                    size: 5
                },
                legend: {
                    show: false
                }
            },
            series: [
                {
                    name: 'Prestamos',
                    data: [230, 45, 45, 50, 49, 160, 70, 91, 70, 191, 140, 91]
                },
                         {
                    name: 'Rachazados',
                    data: [10, 30, 30, 60, 219, 40, 120, 11, 10, 121, 70, 91]
                },
                         {
                    name: 'Clientes',
                    data: [50, 10, 123, 12, 12, 70, 20, 200,70, 21, 120, 191]
                }
            ]
        }
    },
    async created() { 
        await this.getCurrentUser()
        await this.getClients() 

    },
    methods: {
        getCurrentUser () {
            
            axios.get("/currentUser")
            .then(res => { 
                this.currentUser = res.data 
                console.log(this.currentUser)
                this.getPrestamos();   
            })
            },
            getClients() {
                this.clientes= [];
                this.$http 
                    .get(
                    '/clientes/search/'+'4'+'/'+'',          
                    )
                    .then(response => {
                    this.clientes=response.data
                    })
            },  
        getPrestamos() {
            
        this.prestamos = []
        this.$http 
        .get(
            '/prestamos/search/'+'2'+'/'+''
        ) 
        .then(response => {
            response.data.map(prestamo=>{
            if(!this.prestamos.find(element=>element.id==prestamo.id)){
                if(this.currentUser.nivel==3 && prestamo.evaluaciones.length>0 ) {
                prestamo.evaluaciones.map(item=>{
                    if(item.user_id!=this.currentUser.id){
                        this.prestamos.push(prestamo)
                    }     
                })
                }else 
                this.prestamos.push(prestamo) 
            }

            
            
            for (let index = 0; index < this.prestamos.length; index++) {
                
                if(this.currentUser.nivel==4){
                    if(this.currentUser.id==this.prestamos[index].user_id){

                            this.prestamo_total++

                            if(this.prestamos[index].estado=='2'){
                                this.prestamo_prendiente++
                            }
                            else if(this.prestamos[index].estado=='4'){
                                this.prestamo_rechazado++
                            }
                            else if(this.prestamos[index].estado=='1'){
                                this.prestamo_proceso++
                            }
                            else if(this.prestamos[index].estado=='3'){
                                this.prestamo_aprobado++
                            }
                            else if(this.prestamos[index].estado=='5'){
                                this.prestamo_observado++
                            }
                    }
                }
                else{ 
 
                    this.prestamo_total++

                            if(this.prestamos[index].estado=='2'){
                                this.prestamo_prendiente++
                            }
                            else if(this.prestamos[index].estado=='4'){
                                this.prestamo_rechazado++
                            }
                            else if(this.prestamos[index].estado=='1'){
                                this.prestamo_proceso++
                            }
                            else if(this.prestamos[index].estado=='3'){
                                this.prestamo_aprobado++
                            }
                            else if(this.prestamos[index].estado=='5'){
                                this.prestamo_observado++
                            }

                }
                
            } 
            
            })
        })
        }, 
        goToClient(cliente) {
            //this.$router.push({ name:'perfil', params: { documento: cliente.documento, persona: "PN" } })
        }
    }
}
</script> 
<style lang="sass" scoped>
@import "../../sass/_variables"
.dashboard_content
    .dashboard_wrapper
        display: grid
        grid-template-areas: "numbers map" "chart map" "lists map"
        grid-template-columns: 1fr 500px
        grid-template-rows: 200px 400px 450px
        grid-auto-rows: max-content
        grid-gap: 15px
        padding: 20px
        box-sizing: border-box
        .title
            font-size: 12px
            margin: 0
            width: 100%
            border-bottom: 1px solid $line_color
            font-weight: 700
            padding: 7px 20px
            text-transform: uppercase
            box-sizing: border-box 
            background-color: white
        .numbers_stats
            display: grid
            grid-area: numbers 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 15px
            .number_item
                background-color: white
                border-radius: 4px
                box-shadow: $shadow
                height: 100%
                display: flex
                align-items: center
                padding: 20px
                box-sizing: border-box
                border: 1px solid $line_color
                &.n1
                    i
                        color: $primary_color
                        background-color: rgba($primary_color, .2)
                &.n3
                    i
                        color: $require_color
                        background-color: rgba($require_color, .2)
                &.n2
                    i
                        color: $highlight_color
                        background-color: rgba($highlight_color, .2)
                i
                    width: 50px
                    height: 50px
                    background-color: red
                    border-radius: 50%
                    display: flex
                    justify-content: center
                    align-items: center
                .stat
                    margin-left: 15px
                    h1, p
                        margin: 0
                    h1
                        font-size: 23px
                        font-weight: 700
                    p
                        font-size: 13px
                        margin-top: -2px
        .chart_stats
            grid-area: chart 
            background-color: white
            border-radius: 4px
            overflow: hidden
            box-shadow: $shadow
            border: 1px solid $line_color
            #chart
                padding-right: 15px
        .lists
            display: grid
            grid-area: lists 
            grid-template-columns: repeat(3, 1fr)
            grid-gap: 15px
            .list_client, .list_credits
                background-color: white
                border-radius: 4px
                overflow: hidden
                box-shadow: $shadow
                height: 100%
                border: 1px solid $line_color
                .empty_message
                    height: 100% 
            .list_credits
                grid-column: 2 / 2 span
                table
                    &.no_hover 
                        tbody:hover tr
                            background-color: inherit
                    thead, tbody
                        tr
                            margin-bottom: 0px
                            border-bottom: 1px solid $line_color
                    thead tr
                        border-radius: 0
                    tbody
                        tr:last-child
                            border-radius: 0
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
                            .name_wrapper
                                text-align: left
                                margin-left: 10px
                                p
                                    margin: 0
                                    text-align: left
                                    font-weight: 500
                                small
                                    font-size: 11px
                                    display: none
                        .progress_bar
                            width: 150px
                            display: flex
                            align-items: center
                            span
                                display: block
                                flex: 1
                                height: 5px
                                border-radius: 10px
                                background-color: $line_color
                            p
                                margin: 0
                                margin-left: 10px
            .list_client
                ul.list_client_wrapper
                    padding: 0
                    margin: 0
                    overflow: auto
                    height: 420px
                    li 
                        display: flex
                        align-items: center
                        height: 60px
                        border-bottom: 1px solid $line_color
                        box-sizing: border-box 
                        padding: 0 20px
                        cursor: pointer
                        .avatar
                            margin-right: 10px
                            position: relative
                            .request
                                position: absolute
                                left: 0
                                top: 0
                                width: 35px
                                height: 35px
                                background-color: lighten($highlight_color, 45%)
                                border-radius: 50%
                                display: flex
                                align-items: center
                                justify-content: center
                                font-size: 17px
                                font-weight: 600
                                color: $highlight_color
                                i
                                    font-size: 18px
                                    color: $highlight_color
                            .avatar_alt
                                width: 35px
                                height: 35px
                                background-color: $line_color
                                border-radius: 50%
                                display: flex
                                align-items: center
                                justify-content: center
                                font-size: 17px
                                font-weight: 600
                                color: $primary_color
                                &.denied
                                    background-color: lighten($require_color, 45%)
                                    color: $require_color
                            img
                                width: 30px
                                height: 30px
                                border-radius: 50%
                                object-fit: cover
                                position: relative
                                border: 2px solid white
                                background-color: white
                        .name
                            h1
                                font-size: 12px
                                margin: 0
                                color: $text_color
                            p
                                font-size: 11px
                                margin: 0
                                color: $text_color

        .map
            grid-area: map
            background-color: white
            border-radius: 4px
            box-shadow: $shadow
            height: calc(100vh - 95px)
            overflow: hidden
            position: sticky
            top: 75px
            border: 1px solid $line_color

@media screen and (max-width: 1300px)
    .dashboard_content
        .dashboard_wrapper
            grid-template-columns: 1fr 300px
            .title
                font-size: 11px
            .numbers_stats
                .number_item
                    i
                        width: 40px
                        height: 40px
                        font-size: 20px
                    .stat
                        p
                            font-size: 12px

@media screen and (max-width: 1100px)
    .dashboard_content
        .dashboard_wrapper
            grid-template-columns: 1fr
            grid-template-rows: inherit
            grid-template-areas: "numbers numbers" "chart chart" "lists lists" "map map"
            .lists
                grid-template-columns: 1fr
                .list_client
                    ul.list_client_wrapper
                        height: auto
                    .empty_message
                        height: 350px
                .list_credits 
                    grid-column: 1
                    ul
                        height: auto
                    .empty_message
                        height: 350px
            .map
                height: 350px     

@media screen and (max-width: 720px)
    .dashboard_content
        .dashboard_wrapper
            grid-gap: 10px
            grid-template-areas: "numbers numbers" "lists lists" "map map"
            .chart_stats
                display: none
            .lists
                grid-gap: 10px
                .list_client
                    ul.list_client_wrapper
                        li
                            padding: 0 15px
                .list_credits
                    table
                        thead
                            display: none
                        tbody
                            .client
                                .name_wrapper small
                                    display: block
                            tr
                                td
                                    display: none
                                td
                                    &:nth-child(1)
                                        display: flex
            .numbers_stats
                grid-template-columns: 1fr
                grid-gap: 10px
                .number_item
                    padding: 15px

@media screen and (max-width: 500px)
    .dashboard_content
        .dashboard_wrapper
            padding: 15px
</style>