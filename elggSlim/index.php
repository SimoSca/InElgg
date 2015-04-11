<?php
require 'vendor/autoload.php';

/** 
 * APILogWriter: Custom log writer for our application
 *
 * We must implement write(mixed $message, int $level)
*/
class APILogWriter {

	public function write($message, $level = \Slim\Log::DEBUG) {

		# Simple for now
		echo $level.': '.$message.'<br />';

	}

}

// template personalizzato, da inserire nella config
class CustomView extends \Slim\View
{
    public function render($template, $data=null){
        //$template === 'show.php'
        // $this->data['title'] === 'Sahara'
    	// naturalmente potre usare una opportuna pagina php creata ad hoc!
        var_dump($template);
        var_dump($this->data);
        include_once($template);
    }
}



// parte la mia app
$app = new \Slim\Slim(array(
		'mode' => 'development',
		'debug' => true,
		'view' => new CustomView(), // definito sopra
		'log.enabled' => true,
		'log.level' => \Slim\Log::DEBUG,
		'log.writer' => new APILogWriter()
	)
);

//  $settingValue = $app->config(); //returns "../templates"
// echo $settingValue;


// slim capisce che la richiesta viene fatta a /users/nomeDiUtente
// e in base a questo attiva la funzione di ritorno
//  in sostanza e' un MVC!!!
$app->get('/users/:name', function($name){
	echo __FILE__;
    echo "Hello " . $name;
});

/**
 * Setup a GET path for /foo
 */
$app->get('/template/:id', function ($id) use ($app) {
	echo __LINE__;
    $app->render('template.php', array('id' => $id));
});

$app->get('/books:id', function($id) use($app) {
    //Show book identified by $id
    //echo $id;
	var_dump($app->router()->getCurrentRoute());
    echo "omg!";
});
 // var_dump($_SERVER);
 // $req = $app->request();
 // $resourceUri = $req->getResourceUri();
 // var_dump($req);
 // echo "<br>" . $resourceUri . "</b>";

$app->run();

