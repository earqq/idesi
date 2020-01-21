import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
        {
            path: '/inicio',
            name: 'inicio',
            component: require('./views/Inicio').default
        },
        {
            path: '/',
            name: 'inicio',
            component: require('./views/Inicio').default
        },
        { 
            path: '/clientes',
            name: 'clientes',
            component: require('./views/Clientes').default
        },
        {
            path: '/clientes/registrar/natural',
            name: 'registrar/natural',
            component: require('./views/PersonaNatural').default
        },
        {
            path: '/clientes/registrar/juridico',
            name: 'registrar/juridico',
            component: require('./views/PersonaJuridico').default
        },
        { 
            path: '/eval-cualitativa/:prestamo',
            name: 'evalCualtitativa',
            component: require('./views/EvalCualitativa').default
        },
        {
            path: '/eval-cuantitativa/:prestamo',
            name: 'evalCuantitativa',
            component: require('./views/EvalCuantitativa').default
        },
        {
            path: '/evaluaciones',
            name: 'evaluaciones',
            component: require('./views/Evaluaciones').default
        },
        {
            path: '/usuarios',
            name: 'usuarios',
            component: require('./views/Usuario').default
        },

        {
            path: '/lista-evaluaciones',
            name: 'evaluaciones_final',
            component: require('./views/EvaluacionFinal').default
        },

        {
            path: '/perfil/:documento',
            name: 'perfil',
            component: require('./views/Perfil').default,
        },
        {
            path: '/perfiljuridico/:documento',
            name: 'perfiljuridico',
            component: require('./views/PerfilJuridico').default,
        },
        {
            path: '/ver/:prestamo',
            name: 'ver',
            component: require('./views/VerPrestamo').default
        },
        {
            path: '/verjuridico/:prestamo',
            name: 'verjuridico',
            component: require('./views/VerPrestamoJuridico').default
        },
        {  
            path: '/archivos/:prestamo', 
            name: 'archivos',
            component: require('./views/Archivos').default
        },
        {
            path: '/visitas/:prestamo',
            name: 'visitas',
            component: require('./views/Visita').default
        },
        {
            path: '/prestamo/:dni',
            name: 'prestamo',
            component: require('./views/Prestamo').default
        },
        {
            path: '/prestamojuridico/:dni',
            name: 'prestamojuridico',
            component: require('./views/PrestamoJuridico').default
        },
        {
            path: '*',
            component: require('./views/404').default
        },
    ],
    mode: 'hash'
})