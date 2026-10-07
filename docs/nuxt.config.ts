/**
 * Copyright 2026 (C) IDMarinas - All Rights Reserved
 *
 * Last modified by "IDMarinas" on 07/10/2026, 21:20
 *
 * @project IDMarinas Template Bundle
 * @see https://github.com/idmarinas/idm-template-bundle
 *
 * @file nuxt.config.ts
 * @date 07/10/2026
 * @time 21:20
 *
 * @author Iván Diaz Marinas (IDMarinas)
 * @license BSD 3-Clause License
 *
 * @since 1.0.0
 */

export default defineNuxtConfig({
	extends: ['github:idmarinas/nuxt-layers/docs-bundle#master', 'docus'],
	docsBundle: {
		libraries: [
			{
				title: 'Symfony Components',
				icon: 'i-tabler-brand-symfony',
				to: 'https://www.symfony.com/components',
				description: 'This project relies on these components for most of its features.'
			},
			{
				title: 'Other component',
				icon: 'i-tabler-components',
				to: 'https://www.example.com',
				description: 'Other Component used in this project.'
			}
		],
		socials: {
			x: 'https://x.com/idmarinas',
			reddit: 'https://reddit.com/u/idmarinas',
			paypal: 'https://www.paypal.me/idmarinas',
			bitly: 'https://bit.ly/m/idmarinas',
			githubsponsors: 'https://github.com/sponsors/idmarinas',
			linkedin: 'https://linkedin.com/in/idmarinas',
		},
		support_links: {
			title: 'Support me',
			links: [
				{
					icon: 'i-tabler-brand-paypal',
					label: 'PayPal.Me',
					to: 'https://www.paypal.me/idmarinas',
					target: '_blank'
				},
				{
					icon: 'i-tabler-brand-github',
					label: 'GitHub Sponsor',
					to: 'https://github.com/sponsors/idmarinas',
					target: '_blank'
				}
			]
		},
	},
	// $production: {
	// 	llms: {
	// 		domain: 'https://idmarinas.github.io/template-bundle'
	// 	}
	// },
	devServer: {host: "localhost"},
	vite: {
		optimizeDeps: {
			include: [
				'@vue/devtools-core',
				'@vue/devtools-kit',
			]
		}
	}
})
