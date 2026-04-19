export default defineNuxtConfig({
	extends: ['github:idmarinas/nuxt-layers/docs-bundle#master', 'docus'],
	modules: ['nuxt-studio'],
	docsBundle: {},
	$production: {
		llms: {
			domain: 'https://idmarinas.github.io/template-bundle'
		}
	},
	vite: {
		optimizeDeps: {
			include: [
				'@vue/devtools-core',
				'@vue/devtools-kit',
			]
		}
	}
})
