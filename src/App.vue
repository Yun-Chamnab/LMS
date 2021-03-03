<template>
	<div id="app">
		<v-app id="inspire" class="custom_theme">		
			<v-main>
			<!-- <Header/> -->
				<router-view/>
			</v-main>
		</v-app>
	</div>
</template>

<script>
	// import Header from './components/Header.vue'
	// const instituteHandler	= require("../src/scripts/instituteHandler.js")

	export default {
		name: "App",
		data: () => ({
		}),
		props: {
		},
		methods: {
		},
		components: {
			
			
		},
		created () {
			// Initial Institute
			// instituteHandler.init()
		},
	};
</script>