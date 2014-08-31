requirejs.config({
    appDir: ".",
    baseUrl: "js",
    paths: {
        /* Load jquery from google cdn. On fail, load local file. */
        'jquery': ['//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min', 'libs/jquery.min'],
        /* Load bootstrap from cdn. On fail, load local file. */
        'bootstrap': ['//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min', 'libs/bootstrap.min'],
        'reactjs': ['//cdnjs.cloudflare.com/ajax/libs/react/0.11.1/react.min', 'libs/react.min'],
        'jsx': ['//cdnjs.cloudflare.com/ajax/libs/react/0.11.1/JSXTransformer', 'libs/JSXTransformer']
    },
    shim: {
        /* Set bootstrap dependencies (just jQuery) */
        'bootstrap' : ['jquery']
    }
});

require(['jquery', 'bootstrap', 'reactjs', 'jsx'], function(util) {
    console.log("Loaded :)");
    return {};
});