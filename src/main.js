import Vue from 'vue'
import './assets/styles/main.css'
// Import font
// import './assets/accounting-banhji/style.css'
import App from './App.vue'
import vuetify from './plugins/vuetify'
import router from './router'
import { i18n } from './i18n'
import { Trans } from './plugins/Translation'
import DatetimePicker from 'vuetify-datetime-picker'
import BTable from 'bootstrap-vue'

import fullscreen from 'vue-fullscreen'
Vue.prototype.$i18nRoute = Trans.i18nRoute.bind(Trans)

Vue.config.productionTip = false
Vue.use(DatetimePicker)
Vue.use(BTable)
// Vue.use(GridInstaller)
// Vue.use(DataSourceInstaller)

Vue.use(fullscreen)

new Vue({
	vuetify,
	i18n,
	router,
	render: h => h(App),
	components: {
	},
}).$mount('#app')