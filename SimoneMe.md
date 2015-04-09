# SERVER

- attualmente sto usando Apache 2.4.9, PHP 5.5.12, MySql 5.6.17



# ELGG

- attualmente ho installato la versione 1.9.7 del 15/12/2014
- ElggSite è la cartella che ho impostato personalmente: dove elgg salva i dati (cache etc etc)
- durante l'installazione, per ovviare a un problema di mod rewrite, ho dovuto attivare il modulo ... (non ricordo quale, ma basta controllare il l'error log di apache).



# Foowd_Alpha2 
  *(deve rimanere così ed essere esterna all'installazione di elgg)*

### Directory Principali

- **api_offerte**,

    che contiene il codice del modulo offerta. All'interno il codice l'ho organizzato secondo questa impostazione


- **mod_elgg**,

    che contiene i plugin per elgg

- **doc**,

    dove metto la documentazione e i tutorial



### Specifiche
- Le estensioni di elgg devono essere poi inserite in <path installazione elg>/mod ad esempio  /var/www/htdocs/elg/mod/ , 
e poi attivati dal pannello amministatore elgg.

- Il modulo api deve  essere inserito nella root di apache  
/var/www/htdocs/api_offerte/ 
per questa installazione vedi il mio tutorial https://github.com/coder-molok/foowd_alpha2/blob/master/doc/tutorial_sviluppo.md

- Per rendere il path piu pulito e non dover copiare e incollare in seguito a cambiamenti nella branch origin/master del progetto, creo direttamente dei link simbolici (per fare in modo che il server riesca a leggerli come directory).

    - da www
    
        mklink /D api_offerte ElggProject\foowd_alpha2\api_offerte

    - da elgg.../mod
    
        mklink /D foowd_offerte C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_offerte
    
        mklink /D foowd_theme C:\wamp\www\ElggProject\foowd_alpha2\mod_elgg\foowd_theme



# works

###Utenti
modificare

creare - fatto
eliminare - fatto

###Offerte
limite e offset - fatto
ricerca offerte, per tag , per data, - fatto
ordinamento prezzo, data - fatto
quali e in che ordine - fatto
filtri produttore data stato tag - fatto


###Ordini


###Gruppi

###Preferenze
elenco preferenze di un utente - fatto
elenco preferenze sull'ordine - fatto

aggiungi preferenza - fatto
aggiornare - fatto
rimuovere - fatto



###Tags
descrizione 
nome - fatto

