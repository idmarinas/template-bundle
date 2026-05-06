export default defineNuxtConfig({
	extends: ['github:idmarinas/nuxt-layers/docs-bundle#master', 'docus'],
	docsBundle: {
		socials: {
			x: 'https://x.com/idmarinas',
			reddit: 'https://reddit.com/u/idmarinas',
			paypal: 'https://www.paypal.me/idmarinas',
			bitly: 'https://bit.ly/m/idmarinas',
			githubsponsors: 'https://github.com/sponsors/idmarinas',
			linkedin: 'https://linkedin.com/in/idmarinas',
		},
	},
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
