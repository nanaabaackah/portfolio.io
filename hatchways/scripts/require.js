require.config({
    paths: {
      'fontawesome': 'vendor/fontawesome/fontawesome.min',
      'fontawesome/solid': 'vendor/fontawesome/solid.min'
    },
    shim: {
      'fontawesome': {
        deps: ['fontawesome/solid']
      }
    }
  })

  require(['fontawesome'], function (fontawesome) {
    console.log('Congrats, Font Awesome is installed using Require.js')
  })