module.exports = {
	runtimeCompiler: true,
	pluginOptions: {
		i18n: {
			locale: 'en',
			fallbackLocale: 'kh',
			localeDir: 'locales',
			enableInSFC: false
		},
	},
	css: {
		extract: { ignoreOrder: true },
		loaderOptions: {
			scss: {
				prependData: `@import "~@/assets/scss/_font.scss";`
			}
		},
	},
	chainWebpack: config => {
		const svgRule = config.module.rule('svg')

		// clear all existing loaders.
		// if you don't do this, the loader below will be appended to
		// existing loaders of the rule.
		svgRule.uses.clear()

		// add replacement loader(s)
		svgRule
			.test(/\.(svg)$/)
			.use('html-loader')
			.loader('html-loader')
			.options({
				attrs: ['div:v-html']
			})
	},
	configureWebpack:{
		performance: {
			hints: false
		},
		optimization: {
			splitChunks: {
				minSize: 10000,
				maxSize: 250000,
			}
		}
	},
	"transpileDependencies": [
		"vuetify"
	]
}