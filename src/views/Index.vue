<template>
	<div id="app">
		<v-app id="inspire" class="custom_theme">		
            <Header/>
				<router-view/>
		</v-app>
	</div>
</template>

<script>
import Header from '../components/Header.vue'
	export default {
		name: "Index",
		data: () => ({
		}),
		props: {
		},
		methods: {
		},
		components: {
            Header				
		},
		created () {

		},
	};
</script>