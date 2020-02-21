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
                         if(res.data.nivel=='1' || res.data.nivel=='2' || res.data.nivel=='4' ){
                                next()
                         }
                        //  else if(res.data.nivel=='4'){
                        //         next('/clientes')
                        //  }
                         else if(res.data.nivel=='3' || res.data.nivel=='5'  ){
                            next('/prestamos')
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
                                next('/prestamos')
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
            path: '/prestamos',
            name: 'prestamos',
            component: require('./views/Prestamos').default,
        },       
        {
            path: '/prestamos/:prestamoID',
            name: 'prestamo',
            component: require('./views/Prestamo').default,
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
            path: '/prestamos/persona/registrar/:clienteID/:prestamoID',
            name: 'registarPrestamo', 
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
            path: '/prestamos/empresa/registrar/:clienteID/:prestamoID',
            name: 'registrarPrestamoEmpresa',
            component: require('./views/RegistrarPrestamoEmpresa').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
                        if(res.data.nivel=='2'  || res.data.nivel=='4')
                            next()
                        else
                            next('/error')
                    })
            }
        },       
        {
            path: '/prestamos/evaluar/:prestamoID',
            name: '/prestamos/evaluar/',
            component: require('./views/EvaluarPrestamo').default,
            beforeEnter: (to, from, next) => {
                axios.get("/currentUser")
                    .then(res => { 
                        if(res.data.nivel=='2' || res.data.nivel=='3'){
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
            path: '/prestamos/evaluacion/cualitativa/:prestamoID',
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
            path: '/prestamos/evaluacion/cuantitativa/:prestamoID',
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
            path: '/prestamos/archivos/:prestamoID', 
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
            path: '/error',
            name: 'error',
            component: require('./views/Error').default
        },

    ],
    mode: 'hash'
})