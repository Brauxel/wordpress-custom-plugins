const webpack = require('webpack');

//const HTMLWebpackPlugin = require('html-webpack-plugin');
/*const HTMLWebpackPluginConfig = new HTMLWebpackPlugin({
	template: __dirname + '/app/blog-nmb.html',
	filename: 'index.html',
	inject: 'body'
});*/

const ExtractTextPlugin = require("extract-text-webpack-plugin");

const extractSass = new ExtractTextPlugin({ // define where to save the file
      filename: 'next-investors.css',
      allChunks: true
});

const minifyJS = new webpack.optimize.UglifyJsPlugin({
	minimize: false
});

module.exports = {
	entry: [__dirname + '/app/index.js', __dirname + '/app/index.css'],
	module: {
		rules: [
			{
				test: /\.js$/,
				exclude: /node_modules/,
				use: 'babel-loader'
			},
			{
				test: /\.(jpg|png|svg)$/,
				loader: 'file-loader',
				options: {
					name: './images/[name].[ext]',
				},
			},
			{
				test: /\.(woff|woff2|eot|ttf)$/,
				loader: 'file-loader',
				options: {
					name: './fonts/[name].[ext]',
				},
			},
			{
				test: /\.css$/,
	            use: ExtractTextPlugin.extract({
	                use: [
	                	{
	                		loader: 'css-loader',
	                		options: {
	                			minimize: false
	                		}

	                	}, 
	                	{loader: 'sass-loader'}, 
	                	{loader: 'postcss-loader'}
	                ],
	                fallback: 'style-loader'
	            })
			}
		]
	},
	output: {
		path: __dirname + '/assets',
		filename: 'core.js'
	},
	devServer: {
		port: 3000
	},
	plugins: [extractSass, minifyJS]
};