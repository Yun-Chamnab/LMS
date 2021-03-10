import Vue from 'vue'
import VueRouter from 'vue-router'
import { Trans } from '@/plugins/Translation'
const store         = require("../institute.js")
let historyPages 	= store.default.getters.getHistoryPages

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
				path: '/overview',
				name: 'Overview',
				component: load('overview/Overview'),
				meta:{
					mainMenu: 'overview'
				}
			},
			{
				path: 'user',
				name: 'User',
				component: load('user/User'),
				meta:{
					mainMenu: 'user'
				}
			},
			{
				path: 'exam',
				name: 'Exam',
				component: load('exam/Exam'),
				meta:{
					mainMenu: 'exam'
				}
			},
			{
				path: 'question/:id',
				name: 'Dialogue',
				component: load('exam/DialogQuestion'),
				meta:{
					mainMenu: 'exam'
				}
			},
			{
				path: 'course',
				name: 'Course',
				component: load('course/Course'),
				meta:{
					mainMenu: 'course'
				}
			},
			{
				path: 'feedback',
				name: 'Feedback',
				component: load('feedback/Feedback'),
				meta:{
					mainMenu: 'feedback'
				}
			},
			{
				path: 'attendance',
				name: 'Attendance',
				component: load('attendance/Attendance'),
				meta:{
					mainMenu: 'attendance'
				}
			},
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

// Router After Hooks
router.afterEach((to) => {
	// Remove existing route
	let oldIndex = historyPages.findIndex(i => i.name === to.name)
	if (oldIndex > -1) {
		historyPages.splice(oldIndex, 1)
	}
	// Add route
	store.default.commit("setHistoryPage", to)
})

export default router