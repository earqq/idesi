import Vue from 'vue'
import Router from 'vue-router'
import Axios from 'axios'

Vue.use(Router)
export default new Router({
    routes:[
        {
            path: '/',
            name: 'inicio',
            component: require('./views/Inicio').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
                         if(res.data.idrol=='4' || res.data.idrol=='1' ){
                                next()
                         }else if(res.data.idrol=='2'){
                                next('/clientes')
                         }
                         else if(res.data.idrol=='3'){
                            next('/evaluaciones')
                            }
                    })
            }

        },
        { 
            path: '/clientes',
            name: 'clientes',
            component: require('./views/Clientes').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
                        
                         if(res.data.idrol=='3'){
                                next('/evaluaciones')
                         }else{
                                next()
                         }
                    })
            }
        },
        {
            path: '/clientes/registrar/natural',
            name: 'registrar/natural',
            component: require('./views/PersonaNatural').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/clientes/registrar/juridico',
            name: 'registrar/juridico',
            component: require('./views/PersonaJuridico').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/error',
            name: 'error',
            component: require('./views/Error').default
        },
        { 
            path: '/eval-cualitativa/:prestamo/:documento/:persona',
            name: 'evalCualtitativa',
            component: require('./views/EvalCualitativa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/eval-cuantitativa/:prestamo/:documento/:persona',
            name: 'evalCuantitativa',
            component: require('./views/EvalCuantitativa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        }, 
        {
            path: '/ver/prestamo/:prestamo',
            name: '/ver/prestamo/',
            component: require('./views/DetallePrestamo').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='3' || res.data.idrol=='4' || res.data.idrol=='5' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        }, 
        { 
            path: '/usuarios',
            name: 'usuarios',
            component: require('./views/Usuario').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='4' || res.data.idrol=='1' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
            
        },
 
        {
            path: '/evaluaciones',
            name: 'evaluaciones',
            component: require('./views/Evaluacion').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='3' || res.data.idrol=='4' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },

        {
            path: '/perfil/:documento/:persona',
            name: 'perfil', 
            component: require('./views/Perfil').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2'  || res.data.idrol=='4'  ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        }, 
        {
            path: '/evaluacion/detalle/:prestamo',
            name: '/evaluacion/detalle/',
            component: require('./views/EvaluacionDetalle').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='3' || res.data.idrol=='4' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/editar/solicitud/credito/natural/:prestamo/:dni',
            name: '/editar/solicitud/credito/natural/',
            component: require('./views/VerPrestamo').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='4'){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        { 
            path: '/editar/solicitud/credito/juridica/:prestamo/:dni',
            name: '/editar/solicitud/credito/juridica/',
            component: require('./views/VerPrestamoJuridico').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2'   || res.data.idrol=='4'   ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {  
            path: '/archivos/:prestamo', 
            name: 'archivos',
            component: require('./views/Archivos').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='3' || res.data.idrol=='4'){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/visitas/:prestamo',
            name: 'visitas',
            component: require('./views/Visita').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2' || res.data.idrol=='3' || res.data.idrol=='4' || res.data.idrol=='5' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/prestamo/:dni',
            name: 'prestamo',
            component: require('./views/Prestamo').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2'  || res.data.idrol=='4'   ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/prestamojuridico/:dni',
            name: 'prestamojuridico',
            component: require('./views/PrestamoJuridico').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.idrol=='2'   || res.data.idrol=='4'   ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '*',
            component: require('./views/404').default
        },
    ],
    mode: 'hash'
})