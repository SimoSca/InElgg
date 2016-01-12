<?php
/**
 * Step 1: Require the Slim Framework
 *
 * If you are not using Composer, you need to require the
 * Slim Framework and register its PSR-0 autoloader.
 *
 * If you are using Composer, you can skip this step.
 */
#require 'Slim/Slim.php';

#\Slim\Slim::registerAutoloader();

require '../app/vendor/autoload.php';


require_once  '../app/generated-conf/config.php';
/**
 * Step 2: Instantiate a Slim application
 *
 * This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new \Slim\Slim();

$app->config(array(
    'debug'             => true
    //'mode'              => 'development',
    //'templates.path'    => '../templates'
));


require '../app/controller/offerte.php';

//echo "sono api index";
// regex to strip /simone/ from urirequest
$env = $app->environment();
$env['PATH_INFO'] = preg_replace('@simone/@','', $env['PATH_INFO']);
//var_dump($app->environment());
//check validity
//$req = $app->request;
//var_dump($req->getResourceUri());



/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});



// GET route
$app->get( '/', function () use($app) {
//         $template = <<<EOT

// EOT;
//         echo $template;
        $app->render('index.php');
    }
);

$app->notFound(function () use ($app) {

    // vedi paragrafo ENVIRONMENT e RESOURCE URI
    
    // Get request object
    $req = $app->request;

    //Get root URI
    //$rootUri = $req->getRootUri();

    //Get resource URI, that is the App's Route
    $resourceUri = $req->getResourceUri();

    var_dump("Route not found: ".$resourceUri);

            //var_dump(debug_backtrace());

            // build response
            // $response = array(
            //     'type' => 'not_found',
            //     'message' => 'The requested resource does not exist.'
            // );

            // // output response
            // $app->halt(404, json_encode($response));

});

/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
