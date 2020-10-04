const Encore = require('@symfony/webpack-encore')
Encore
  .setOutputPath('public/build/')
  .setPublicPath('/build')
  .addStyleEntry('tailwind', './assets/css/tailwind.css')
  .addEntry('js/app', './assets/js/app.js')
  // enable post css loader
  .enablePostCssLoader();
module.exports = Encore.getWebpackConfig()