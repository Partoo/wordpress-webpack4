let path = require('path')
const UglifyJsPlugin = require('uglifyjs-webpack-plugin')
const MiniCssExtractPlugin = require('mini-css-extract-plugin')
const OptimizerCssAssetsPlugin = require('optimize-css-assets-webpack-plugin')
const {CleanWebpackPlugin} = require('clean-webpack-plugin');
const CopyPlugin = require('copy-webpack-plugin');

const env = process.env.NODE_ENV

module.exports = {
	mode: env === 'production' || env === 'none' ? env : 'development',
	entry: [path.resolve(__dirname + '/src/js/main.js'), path.resolve(__dirname + '/src/sass/main.scss')],
	output: {
		path: path.resolve(__dirname + '/dist/js'),
		filename: 'bundle.min.js'
	},
	module: {
		rules: [
			{
				test: /\.scss$/,
				use: [MiniCssExtractPlugin.loader, 'css-loader', 'sass-loader', 'resolve-url-loader']
			},
			{
				test: /\.js$/,
				exclude: /node_modules/,
				loader: 'babel-loader'
			},
			// {
			// 	test: /\.(png|jp(e*)g|svg)$/,
			// 	use: [
			// 		{
			// 			loader: 'url-loader',
			// 			options: {
			// 				limit: 8000,
			// 				name: '[name].[ext]',
			// 				publicPath: path.resolve(__dirname + '/dist/images')
			// 			}
			// 		}
			// 	]
			// },
			{
				test: /\.(woff(2)?|ttf|eot|svg)(\?v=\d+\.\d+\.\d+)?$/,
				use: [
					{
						loader: 'file-loader',
						options: {
							name: '[name].[ext]',
							outputPath: '../fonts'
						}
					}
				]
			}
		]
	},
	plugins: [
		new CleanWebpackPlugin({
			// dry: true,
			verbose: true,
			CleanOnceBeforeBuildPatterns: path.resolve(__dirname + '/dist/*/')
		}),
		new MiniCssExtractPlugin({
			filename: '../css/main.min.css',
		}),
		new OptimizerCssAssetsPlugin({
			cssProcessorOptions: {
				preset: ['default', {discardComment: {removeAll: true}}]
			}
		}),
		new CopyPlugin([
			{from: path.resolve(__dirname + '/src/images/'), to: path.resolve(__dirname + '/dist/images/')},
		])
	],
	optimization: {
		minimizer: []
	}
}

if (env === 'production') {
	module.exports.optimization.minimizer.push(new UglifyJsPlugin)
}
