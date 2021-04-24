import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
       role: []
    },
    mutations: {
        setRole(state, value){
            window.console.log(value);
            state.role = value
        },
    },
    getters: {
        getRole: state=>{
            return state.role
        },
    }
})

export default store;
