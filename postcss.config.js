module.exports = {
	plugins: [
		require('postcss-nested'),
		require('postcss-preset-env'),
		...(process.env.NODE_ENV === "production" ? [require('cssnano')] : []),
	],
};
