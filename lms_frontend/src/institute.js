import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
    state: {
        institute       : {
            currency    : "",
            closingDate : "",
            dateFormat  : "dd-MM-yyyy",
        },
        company         : [],
        prefixes        : [],
        cookies         : {
            accessToken : '',
            refreshToken: '',
            expiresIn   : '',
            email       : '',
            instituteId : 'institute-effdc070-808d-11ea-9131-1d2fe2a803b1',
            creator     : 'cf3d10ab-bce6-47b3-8405-b448c23dad84',
            fisScalId   : '7cda33fc-b6b8-11ea-bb84-74867ad6e338',
        },
        historyPages    : [],
    },
    mutations: {
        setHistoryPage(state, value) {
            state.historyPages.push(value)
        },
    },
    getters: {
        getHistoryPages: state => {
            return state.historyPages
        },
    }
})

export default store;
