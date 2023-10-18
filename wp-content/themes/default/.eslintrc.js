module.exports = {
	'root': true,
	'parser': 'babel-eslint',
	'extends': [
		'eslint:recommended'
	],
	'env': {
		'browser': false,
		'jquery': true,
		'es6': true,
		'amd': true,
		'node': true,
		'jest/globals': true
	},
	'plugins': [ 'react', 'jsx-a11y', 'jest' ],
	'parserOptions': {
		'sourceType': 'module',
		'ecmaVersion': 8,
		'ecmaFeatures': {
			'jsx': true,
			'experimentalObjectRestSpread': true
		}
	},
	'settings': {
		'react': {
			'pragma': 'wp',
			'version': 'latest'
		}
	},
	'globals': {
		'wp': true,
		'$': true,
		'bgx': true,
		'wpApiSettings': true,
		'window': true,
		'document': true,
		'Swiper': true,
		'wc_add_to_cart_params': true,
		'FB': true,
		'google': true
	},
	'rules': {
		'no-console': 'off',
		'no-multi-spaces': 'error',
		'no-debugger': 'error',
		'no-unreachable': 'error',
		'no-multiple-empty-lines': 'error',
		'no-unused-vars': [
			'warn',
			{
				'varsIgnorePattern': '^validate$'
			}
		],
		'no-var': 'error',
		'arrow-spacing': [
			'error',
			{
				'before': true,
				'after': true
			}
		],
		'quotes': [
			'error',
			'single'
		],
		'semi': [
			'error',
			'never'
		]
	}
}