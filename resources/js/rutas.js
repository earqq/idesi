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
            path: ':documento',
            name: 'perfil',
            component: require('./views/Perfil').default
        },
        {
            path: 'prestamo/:dni',
            name: 'prestamo',
            component: require('./views/Prestamo').default
        },
        {
            path: '*',
            component: require('./views/404').default
        },
    ],
    mode: 'history'
})