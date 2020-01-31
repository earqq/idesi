import Vue from 'vue'
import Router from 'vue-router'

Vue.use(Router)

export default new Router({
    routes:[
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
            path: '/eval-cualitativa/:prestamo/:documento/:persona',
            name: 'evalCualtitativa',
            component: require('./views/EvalCualitativa').default
        },
        {
            path: '/eval-cuantitativa/:prestamo/:documento/:persona',
            name: 'evalCuantitativa',
            component: require('./views/EvalCuantitativa').default
        }, 
        {
            path: '/ver/prestamo/:prestamo',
            name: '/ver/prestamo/',
            component: require('./views/DetallePrestamo').default
        }, 
        { 
            path: '/usuarios',
            name: 'usuarios',
            component: require('./views/Usuario').default
        },
 
        {
            path: '/evaluaciones',
            name: 'evaluaciones',
            component: require('./views/Evaluacion').default
        },

        {
            path: '/perfil/:documento/:persona',
            name: 'perfil', 
            component: require('./views/Perfil').default,
        }, 
        {
            path: '/evaluacion/detalle/:prestamo',
            name: '/evaluacion/detalle/',
            component: require('./views/EvaluacionDetalle').default,
        },
        {
            path: '/editar/solicitud/credito/natural/:prestamo/:dni',
            name: '/editar/solicitud/credito/natural/',
            component: require('./views/VerPrestamo').default 
        },
        { 
            path: '/editar/solicitud/credito/juridica/:prestamo/:dni',
            name: '/editar/solicitud/credito/juridica/',
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