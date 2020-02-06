import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        currentUser:{
            idrol:2
        }
    }
})

export default store