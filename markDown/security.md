Security
========

raccolta di idee e consigli in merito alla sicurezza.

***

DATABASE
--------

Attenzione alle `sequel injention`

````
//escaping input (con pdo)
$stmt->bindParam(‘:id’, $id);

//escaping output
htmlentities($_POST[‘name’]);
````




***

Slim Framework
--------------

esempi di `OAuth`: 

- [http://www.lornajane.net/posts/2013/oauth-middleware-for-slim](http://www.lornajane.net/posts/2013/oauth-middleware-for-slim)
- [http://www.sitepoint.com/best-practices-rest-api-scratch-introduction/](http://www.sitepoint.com/best-practices-rest-api-scratch-introduction/)
- [http://alexbilbie.com/2013/02/securing-your-api-with-oauth-2/](http://alexbilbie.com/2013/02/securing-your-api-with-oauth-2/)
- [http://www.9bitstudios.com/2013/06/basic-http-authentication-with-the-slim-php-framework-rest-api/](http://www.9bitstudios.com/2013/06/basic-http-authentication-with-the-slim-php-framework-rest-api/)


PreFlight
=========

tratto da [http://stackoverflow.com/questions/8685678/cors-how-do-preflight-an-httprequest](http://stackoverflow.com/questions/8685678/cors-how-do-preflight-an-httprequest):

***
During the preflight request, you should see the following two headers: Access-Control-Request-Method and Access-Control-Request-Headers. These request headers are asking the server for permissions to make the actual request. Your preflight response needs to acknowledge these headers in order for the actual request to work.

For example, suppose the browser makes a request with the following headers:
````
Origin: http://yourdomain.com
Access-Control-Request-Method: POST
Access-Control-Request-Headers: X-Custom-Header
````
Your server should then respond with the following headers:
````
Access-Control-Allow-Origin: http://yourdomain.com
Access-Control-Allow-Methods: GET, POST
Access-Control-Allow-Headers: X-Custom-Header
````
Pay special attention to the Access-Control-Allow-Headers response header. The value of this header should be the same headers in the Access-Control-Request-Headers request header, and it can not be '*'.

Vedere anche [http://www.html5rocks.com/en/tutorials/cors/](http://www.html5rocks.com/en/tutorials/cors/)
***

OAuth
=====

ottima spiegazione con works flows a 

[https://docs.oracle.com/cd/E39820_01/doc.11121/gateway_docs/content/oauth_flows.html](https://docs.oracle.com/cd/E39820_01/doc.11121/gateway_docs/content/oauth_flows.html)


SITO
====

Per il momento l'idea potrebbe essere di:

- lasciare tutte le **get** libere
- imporre che le **post** rimandino a una pagina elgg, che le filtra svolgendo controlli sull'utente(`elgg_is_logged_in()` etc.)

se si opta per questa strada allora su `Slim Framework` conviene impostare una middleware che operi secondo quanto segue:

- se le chiamate sono `get` non fare alcun controllo extra
- se le chiamate sono `post`, allora dare   `allow` per il server di elgg

oppure da `htaccess` posso svolgere delle `rewrite conditions` come 

````
RewriteCond %{REQUEST_METHOD} !^(GET|HEAD|OPTIONS|POST|PUT)
RewriteCond %{HTTP_HOST} !^www\.askapache\.com$ [NC]
RewriteRule ^(.*)$ /$1 [R=301,L]
````

In cui svolgere un redirect a una pagina d'errore nel caso la chiamata post avvenga da un host diverso dal nostro... 

Probabilmente risulta migliore il controllo tramite `Slim`: a quel punto si possono anche svolgere dei log per salvare alcuni dati e tenere monitorati gli accessi non validi.