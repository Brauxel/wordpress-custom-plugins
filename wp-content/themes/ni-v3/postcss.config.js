const autoPrefixer = require('autoprefixer');
const autoPrefixerConfig = new autoPrefixer({
	browsers : ['last 3 versions']
});

module.exports = {
    plugins: [
        autoPrefixerConfig
    ]
}