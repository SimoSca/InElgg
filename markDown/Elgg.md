Appunti su Elgg
===============

Prima di iniziare...
--------------------

Qui raccolgo links che potrebbero essere utili al sottoscritto... 

### Pagine Chiave

- profile -> vedi modulo profile | bloccare il modulo del profilo
- settings e settings/user
- admin
- login
- register



Elgg Page
---------

Quando sono in un plugin_name e faccio partire il suo *start.php*, li dentro posso impostare le varie rotte da far seguire.

In particolare, se uso l'url *<home>/plugin_name/altra_roba*, allora elgg fa partire la mia *start.php*, e qui dentro registro un page_handler sul plugin_name, cosi' posso chiamare una mia funzione di inizializzazione.

### Funzione di Inizializzazione

Su questa elgg imposta come **$entity** il nome del plugin, e come **$section** l'URL da dopo il */plugin_name/*: Grazie all' *$entity* posso sceglere quale pagina del plugin caricare. 

Le pagine del plugin dovrebbero essere inserite nella directory *pages* subito dentro al plugin, e qui impostare possibilmente un path intelligente.


### Pagina Specifica

*vedi http://learn.elgg.org/en/latest/guides/pagehandler.html*

Supponiamo di aver incluso la pagina in *mod/plugin_name/pages/plugin_name/test.php*.

Dentro questa pagina posso svolgere tutte le operazioni che voglio, ma in particolare richiamare una specifica view. 
Se dovessi dare il comando

````php 
$content .= elgg_view('custom/offersList',array('offersList' => $response));
````

allora elgg andrebbe a utilizzare la view nel percorso 

````
mod/plugin_name/views/default/custom/offersList.php
````

In sostanza le view non sono altro che template da richiamare opportunamente per aggiungere porzioni al mio $content.


# User Experience

*come folder principale indendero' la directory del plugin*

1. decido in che pagina andare, avendo come radice dell'url il nome del plugin
2. dallo start.php del plugin posso usare un page handler in modo che possa indirizzare verso una pagina specifica nella subdirectory **/pages/**
3. da questa pagina richiamata posso impostare il blocco di lavoro e richiamare delle custom view page selezionate dalla directory **/views/**
4. la nuova view provvedera' al rendering della pagina




## Tutorial

Tutorial utile su http://learn.elgg.org/en/latest/tutorials/blog.html

## Hook

Before executing any action, Elgg triggers a hook:

````php
$result = elgg_trigger_plugin_hook('action', $action, null, true);
````

Where $action is the action being called. If the hook returns false then the action will not be executed.

See http://learn.elgg.org/en/latest/guides/actions.html#sticky-forms




## Action Form

Riassumo il giro implementato per svolgere il Form:

1. in start.php registro l'azione: 
 
    quando parte l'azione dalla PAGINA (URL) foowd_offerte/add, in automatico esegue lo script alla pagina indicata, ovvero *foowd_offerte/actions/foowd_offerte/add.php*, inviandogli inoltre gli input del Form

2. in start.php inserisco il path della pagina:
    
    prima che avvenga l'azione (parte solo dopo aver cliccato l'ok nel form) devo mandarlo a una pagina specifica per visualizzare il form. In questo caso quando l' URL e' *foowd_offerte/add* in automatico il mio page handler carica la pagina *foowd_offerte/pages/foowd_offerte/add.php*

3. la pagina appena caricata fa quel che deve fare e 

    carica il view_form *foowd_offerte/add* in */views/default/forms/foowd_offerte/add.php*

#### Sticky Form

gli sticky form servono per mantenere nel form i dati inseriti, nel caso in cui si verifichi un errore: in questo modo l'utente non deve reinserire tutto da capo!!!

Ecco come lo implemento:

1. Nella action del form *foowd_offerte/actions/foowd_offerte/add.php* inserisco *elgg_make_sticky_form('foowd_offerte/add');* , che serve per dire al sistema che il form e' di tipo sticky.

2. Nella pagina *foowd_offerte/pages/foowd_offerte/add.php* richiamo la classe Foowd/Add, che ha il compito di preparare le variabili del form, e di eseguire la validazione: molto consistente.  

    In particolare cosi' imposto le variabili da dare al form: se sono con uno sticky form, allora prendo gli sticky value precedentemente salvati, altrimenti se e' la prima volta che riempio il form e pertanto non ho sticky value, allora non faccio niente.

    In ogni caso faccio un clear dello stycky, in modo da non mantenere valori in background.

3. nel pages file carico la view form passandole le variabili precedentemente impostate.


## ERRORI

##### fai attenzione alla cache!!!

    se dal pannello di amministrazione o dai settings di develop tools la disattivi, allora le azioni e gli handler non rimangono registrati, e quindi non puoi svolgere il lavoro in parallelo, utile ad esempio quando fai il submit di un form, facendo partire la sua azione associata!



Duplicare elgg
===============

utile per testare una nuova versione prima dell'upgrade

1. scarico la nuova versione
2. la estraggo e creo anche la cartella che conterra' i suoi dati, tipo cache etc. Questa deve essere specificata durante l'installazione.

3. comparo .htaccess della 1.9 (quello vecchio), con htaccess.dist in install/config della 1.10 e confronto il vecchio engine/config.php con config.example.php in engine/ della 1.10

4. passaggi effettivamente fatti da me:
    
    - copiato engine/settings.php della vecchia installazione e incollato nella engine/ della nuova (che non lo contiene, naturamente).
    
    A questo punto il file engine/load.php della nuova, non servirebbe, ma lo lascio per sicurezza.     

- copiato e incollato il file .htaccess della vecchia installazione.

5. in generale bisogna ricaricare la cache, andando alla pagina **mio_sito_elgg/upgrade.php**

Links utili:
- vado su http://localhost/ElggProject/elgg-1.10.3/upgrade.php
- http://learn.elgg.org/en/latest/admin/upgrading.html
- vedi http://learn.elgg.org/en/latest/admin/duplicate-installation.html

#### Annotazione in merito alla duplicazione:

per automatizzare questo processo ho creato il file **switchSite.php**.
E' da notare che Elgg, qualora non sia gia' esistente, crea automaticamente la directory **elgg-versio-data**, che ho impostato come director di *cache* e di *files* (come icone).


#### Come metodo alternativo alla Duplicazione

1. Ho creato un database `fake`
2. a tale DB ho assegnato un utente `fake` con pwd `99fake` e su questo DB gli ho garantito tutti i privilegi
3. Ho svolto la normale creazione di Elgg sfruttando i dati del punto 1 e 2
4. per impostare al DB e all'utente di Default ho usato `switchSite.php`
5. rimodificare i dati in `Engine/config.php`, riportandoli al DB reale

In questo modo ho potuto evitare i copia e incolla del passaggio `Specifiche`.



Specifiche
===========

- Le estensioni di elgg devono essere poi inserite in <path installazione elg>/mod ad esempio  /var/www/htdocs/elg/mod/ , 
e poi attivati dal pannello amministatore elgg.

- Il modulo api deve  essere inserito nella root di apache  
/var/www/htdocs/api_offerte/ 
per questa installazione vedi il mio tutorial https://github.com/coder-molok/foowd_alpha2/blob/master/doc/tutorial_sviluppo.md

- Per rendere il path piu pulito e non dover copiare e incollare in seguito a cambiamenti nella branch origin/master del progetto, creo direttamente dei link simbolici (per fare in modo che il server riesca a leggerli come directory).

    - da www/
    
        mklink /D api_foowd ElggProject\foowd_alpha2\api_foowd

    - da elgg.../mod
    
        mklink /D foowd_offerte C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_offerte

        comando globale in dos:
        ````
        mklink /D foowd_offerte C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_offerte && mklink /D foowd_theme C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_theme && mklink /D foowd_utility C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_utility && mklink /D foowd_utenti C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_utenti
        ````
  


Caricare Elgg engine
====================

se voglio inserire elgg sfruttando le sue API da una app esterna, allora posso includere il suo engine via
````php
require_once("path/to/elgg/engine/start.php");
````

