import Vue from 'vue'
import VueRouter from 'vue-router'		
import { Trans } from '@/plugins/Translation'
import store from '../store'
import { i18n } from '../i18n'
// let historyPages 	= store.default.getters.getHistoryPages

function load(component) {
	// '@' is aliased to src/components
	return () => import(`@/views/${component}.vue`)
}

Vue.use(VueRouter)

const originalPush = VueRouter.prototype.push
	VueRouter.prototype.push = function push(location) {
	return originalPush.call(this, location).catch(err => err)
}
const routes = [{
	path: '/:locale',
		beforeEnter: Trans.routeMiddleware,
		component: {
			template: "<keep-alive><router-view></router-view></keep-alive>"
		},
		children: [
			{
				path: '/', 
				component: load('Index'),
				children: [
					{
						path: '',
						name: 'Overview',
						component:load('overview/Overview'),
						meta:{
							mainMenu: 'overview',
							auth: true
							
						},
					},
					{
						path: 'user',
						name: 'User',
						component: load('user/User'),
						meta:{
							mainMenu: 'user',
						
						
						}
					},
					{
						path: 'exam',
						name: 'Exam',
						component: load('exam/Exam'),
						meta:{
							mainMenu: 'Exam',
							
						}
					},
					{
						path: 'course',
						name: 'Course',
						component: load('course/Course'),
						meta:{
							mainMenu: 'Course',
						
						}
					},
					{
						path: 'feedback',
						name: 'Feedback',
						component: load('feedback/Feedback'),
						meta:{
							mainMenu: 'Feedback',
						
						}
					},
					{
						path: 'attendance',
						name: 'Attendance',
						component: load('attendance/Attendance'),
						meta:{
							mainMenu: 'Attendance',
							
						}
					},

				]
			},
			{
				path: 'signin',
				component: load('auth/SignIn'),
				name: 'SignIn',
				meta:{
					guest: 'true'
				}
			},
			{
				path: 'signup',
				component: load('auth/SignUp'),
				name: 'SignUp',
				meta:{
					guest: 'true'
				}
			},
			
			//Signup
			// {
			// 	path: 'signup',
			// 	component: load('auth/Index'),
			// 	meta:{
			// 		auth: false
			// 	},
			// 	children: [
			// 		{
			// 			path: '',
			// 			name: 'SignUp',
			// 			component: load('auth/SignUp'),
			// 			meta:{
			// 				auth: false,
			// 				guest: true
			// 			},
			// 		},
			// 	]

			// },
			
			// {
			// 	path: 'signin',
			// 	component: load('auth/Index'),
			// 	meta:{
			// 		auth: false
			// 	},
			// 	children: [
			// 		{
			// 			path: '',
			// 			name: 'SignIn',
			// 			component: load('auth/SignIn'),
			// 			meta:{
			// 				auth: false,
			// 				guest: true
			// 			},
			// 		},
			// 	]
			// }
		]
	},
	{
		path: '*',
		redirect() {
			return Trans.defaultLocale;
		}
	}
] 

const router = new VueRouter({
	mode: 'history',
	base: process.env.BASE_URL,
	routes
})
// router.beforeEach((to, from, next) => {
// 	if(to.matched.some(record => record.meta.auth)){
// 		if(!store.getters.getLoggedUser){
// 			window.console.log("TOKEN",store.getters.getLoggedUser)
// 			next({
// 				name: 'SignIn'
// 			})
// 		}else{
// 			next()
			
// 		}
// 	}else{
// 		next()
// 	}
// })
// let loggedUser = store.getters.getLoggedUser
router.beforeEach((to, from, next) => {
    // Redirect to route
    let redirectToRoute = function(name) {
		if (name === from.name) {
			next()
			return
        }
        
		next({ name: name , params:{locale: i18n.locale}})
    }
    
    // Get logged user
    let loggedUser = store.getters.getLoggedUser
	window.console.log(loggedUser)

    // Check if access token expired
	if (loggedUser) {
		let currentDateTime = new Date().getTime()
		if (currentDateTime > loggedUser.expiryDate) {
            store.dispatch('logOut')
            return redirectToRoute('SignIn')
		}
	}

    // Auth
    if (to.meta.auth) {
        if (loggedUser)
            return next()
        else
            return redirectToRoute('SignIn')
    }

    // Guest
    if (to.meta.guest) {
        if (loggedUser)
            return redirectToRoute('Overview')
        else
            return next()
    }

    next()
})
// router.beforeEach((to, from, next) =>{
// 	const requiresAuth = to.matched.some(x => x.meta.requiresAuth)
// 	const userLogin = to.match.some(x => x.meta.userLogin)
// 	loggedUser().then(() => {
// 		if(userLogin){
// 			return next({
// 				name: 'Overview',
// 				params:{
// 					locale: i18n.locale
// 				}
// 			})
// 		}else{
// 			next()
// 		}
// 	}).catch(() =>{
// 		if(requiresAuth){
// 			return next({
// 				name: 'SignIn',
// 				params:{ 
// 					locale: i18n.locale
// 				}
// 			})
// 		}else{
// 			next()
// 		}
// 	})

// })
  

// Router After Hooks
// router.afterEach((to) => {
// 	// Remove existing route
// 	let oldIndex = historyPages.findIndex(i => i.name === to.name)
// 	if (oldIndex > -1) {
// 		historyPages.splice(oldIndex, 1)
// 	}
// 	// Add route
// 	store.default.commit("setHistoryPage", to)
// })

export default router