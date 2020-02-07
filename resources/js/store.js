import Vue from 'vue'
import Vuex from 'vuex'


Vue.use(Vuex)

export const store = new Vuex.Store({
    state: {
        currentUser:{
            nivel:2
        }
    }
})

export default store