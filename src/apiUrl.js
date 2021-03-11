'use strict'
import store from './store'
const baseApiUrlLocal = 'http://127.0.0.1:8000/'
if (store.getters.getLoggedUser) {
    baseApiUrlLocal.defaults.headers.common['Authorization'] = 'Bearer ' + store.getters.getLoggedUser.access_token
}

module.exports = {
    // Tax Setting
    user_login                         : baseApiUrlLocal + 'auth/login'
}