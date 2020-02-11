import Vue from 'vue'
import Router from 'vue-router'
import Axios from 'axios'

Vue.use(Router)
export default new Router({
    routes:[
        {
            path: '/',
            name: 'main',
            component: require('./views/Inicio').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
                         if(res.data.nivel=='1' || res.data.nivel=='2' ){
                                next()
                         }else if(res.data.nivel=='4'){
                                next('/clientes')
                         }
                         else if(res.data.nivel=='3' || res.data.nivel=='5'  ){
                            next('/evaluaciones')
                            }
                    })
            }

        },
        {
            path: '/clientes/:id/',
            name: 'perfil', 
            component: require('./views/Cliente').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2'  || res.data.nivel=='4'  ){
                                next()
                         }else{
                            next('/error')
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
                        
                         if(res.data.nivel=='3'){
                                next('/evaluaciones')
                         }else{
                                next()
                         }
                    })
            }
        },
        {
            path: '/clientes/registrar/persona',
            name: 'registrar/persona',
            component: require('./views/AddClientePersona').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2' || res.data.nivel=='4'  ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/clientes/registrar/empresa',
            name: 'registrar/empresa',
            component: require('./views/AddClienteEmpresa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2' || res.data.nivel=='4' ){
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
            path: '/prestamo/:clienteID',
            name: 'prestamo',
            component: require('./views/RegistrarPrestamo').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2'  || res.data.nivel=='4'   ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/prestamo-empresa/:clienteID',
            name: 'prestamoEmpresa',
            component: require('./views/RegistrarPrestamoEmpresa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2'  || res.data.nivel=='4'   ){
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
        { 
            path: '/eval-cualitativa/:prestamo',
            name: 'evalCualitativa',
            component: require('./views/EvalCualitativa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='4' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },
        {
            path: '/eval-cuantitativa/:prestamo',
            name: 'evalCuantitativa',
            component: require('./views/EvalCuantitativa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='4' ){
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
        
                         if(res.data.nivel=='2' || res.data.nivel=='3' || res.data.nivel=='4' || res.data.nivel=='5' ){
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
        
                         if(res.data.nivel=='1' ){
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
          
        },

    
        {
            path: '/evaluacion/detalle/:prestamo',
            name: '/evaluacion/detalle/',
            component: require('./views/EvaluacionDetalle').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
        
                         if(res.data.nivel=='2' || res.data.nivel=='3' || res.data.nivel=='4' ){
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
        
                         if(res.data.nivel=='2' || res.data.nivel=='4'){
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
        
                         if(res.data.nivel=='2'   || res.data.nivel=='4'   ){
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
        
                         if(res.data.nivel=='2' || res.data.nivel=='3' || res.data.nivel=='4'){
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
        
                         if(res.data.nivel=='2' || res.data.nivel=='3' || res.data.nivel=='4' || res.data.nivel=='5' ){
                                next()
                         }else{
                            next('/error')
                         }
                    })
            }
        },

    ],
    mode: 'hash'
})