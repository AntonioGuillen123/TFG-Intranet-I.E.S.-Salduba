const Encore = require('@symfony/webpack-encore');

// Manually configure the runtime environment if not already configured yet by the "encore" command.
// It's useful when you use tools that rely on webpack.config.js file.
if (!Encore.isRuntimeEnvironmentConfigured()) {
    Encore.configureRuntimeEnvironment(process.env.NODE_ENV || 'dev');
}

Encore
    .setOutputPath('public/build/')
    .setPublicPath('/build')
    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enableVersioning(Encore.isProduction())
    .addEntry('app', './assets/app.js')
    .addEntry('messagejs', './assets/js/message.js')
    .addEntry('newsjs', './assets/js/news.js')
    .addStyleEntry('global', './assets/styles/global.scss')
    .addStyleEntry('header', './assets/styles/header.css')
    .addStyleEntry('sidebar', './assets/styles/sidebar.css')
    .addStyleEntry('login', './assets/styles/login.css')
    .addStyleEntry('dashboard', './assets/styles/dashboard.css')
    .addStyleEntry('message', './assets/styles/message.css')
    .addStyleEntry('news', './assets/styles/news.css')
    .enableSassLoader()
    .enablePostCssLoader()
    .enableSingleRuntimeChunk()
    .autoProvidejQuery();

module.exports = Encore.getWebpackConfig();