const _ = require('lodash'),
	path = require('path'),
	ATP = require('autoprefixer'),
	CSSExtract = require('mini-css-extract-plugin')

const { CleanWebpackPlugin } = require('clean-webpack-plugin')

// The path where the Shared UI fonts & images should be sent.
const config = {
	output: {
		imagesDirectory: '../images',
		fontsDirectory: '../fonts',
	},
}

const sharedConfig = {
	mode: 'production',

	stats: {
		colors: true,
		entrypoints: true,
	},

	watchOptions: {
		ignored: /node_modules/,
		poll: 1000,
	},
}

const scssConfig = _.assign(_.cloneDeep(sharedConfig), {
	entry: {
		admin: './assets/src/scss/admin/admin.scss',
	},

	output: {
		filename: '[name].min.css',
		path: path.resolve(__dirname, 'assets/css'),
	},

	module: {
		rules: [
			{
				test: /\.scss$/,
				exclude: /node_modules/,
				use: [
					CSSExtract.loader,
					{
						loader: 'css-loader',
					},
					{
						loader: 'postcss-loader',
						options: {
							plugins: [ATP()],
							sourceMap: true,
						},
					},
					{
						loader: 'sass-loader',
						options: {
							sourceMap: true,
						},
					},
				],
			},
			{
				test: /\.(png|jpg|gif)$/,
				use: {
					loader: 'file-loader', // Instructs webpack to emit the required object as file and to return its public URL.
					options: {
						name: '[name].[ext]',
						outputPath: config.output.imagesDirectory,
					},
				},
			},
			{
				test: /\.(woff|woff2|eot|ttf|otf|svg)$/,
				use: {
					loader: 'file-loader', // Instructs webpack to emit the required object as file and to return its public URL.
					options: {
						name: '[name].[ext]',
						outputPath: config.output.fontsDirectory,
					},
				},
			},
		],
	},

	plugins: [
		new CSSExtract({
			filename: '../css/[name].min.css',
		}),
		new CleanWebpackPlugin(),
	],
})

const jsConfig = _.assign(_.cloneDeep(sharedConfig), {
	entry: {
		embed: './assets/src/js/public/embed.js',
		'embed-count': './assets/src/js/public/embed-count.js',
		'embed-click': './assets/src/js/public/embed-click.js',
		'embed-scroll': './assets/src/js/public/embed-scroll.js',
		'embed-count-click': './assets/src/js/public/embed-count-click.js',
		'embed-count-scroll': './assets/src/js/public/embed-count-scroll.js',
	},

	output: {
		filename: '[name].min.js',
		path: path.resolve(__dirname, 'assets/js'),
	},

	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: {
					loader: 'babel-loader',
					options: {
						presets: ['@babel/env', '@babel/react'],
					},
				},
			},
		],
	},

	devtool: 'source-map',

	plugins: [new CleanWebpackPlugin()],
})

module.exports = [scssConfig, jsConfig]
