export default defineNuxtConfig({
	extends: ['github:idmarinas/nuxt-layers/docs-bundle#master', 'docus'],
	docsBundle: {
		// package_name: 'idmarinas/template-bundle',
		description: 'Short description for your Symfony Bundle',
		versions: [
			/* new versions here. "major.minor" avoid patch versions */
			'1.0'
		]
	},
	app: {
		baseURL: '/'
	},
	$production: {
		app: {
			baseURL: '/template-bundle/'
		},
		llms: {
			domain: (() => {
				// const config = useRuntimeConfig()
				// const docs = config.docsBundle
				return `https://idmarinas.github.io/template-bundle`
			})()
		}
	},
})
