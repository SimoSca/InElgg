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



# TODO

- inserire controlli di sicurezza.
 
    articolo ottimo: http://www.thebuzzmedia.com/designing-a-secure-rest-api-without-oauth-authentication/

    anche https://developers.google.com/identity/protocols/OAuth2





# works
logger totale


###Utenti
aggiungere da admin testare
aggiungere logger

modificare

###Ordini

###Gruppi

###Tags
descrizione 


altro plugin foowd_utenti:
==========================

utente: inserire il poter cambiare dal pannello di amministrazione


gestione utenti e gruppi



interfaccia personalizzata foowd_utente e gruppo - pannello utente
    attributo produttore

aggiunta metadati a entita' utente relativa ai progetto 


creo login google
creo funzione preferenza per aggiungere la relazione sia in elgg che sul db api


altro plugin foowd_utenti:
==========================
capogruppo, offerte, etc.



Extra
======

- ripulire activate.php, deactivate.php e start.php di foowd_offerte
- eliminare il settings dalla view di offerte


livelli di logg 
warning
info 
debug




Inserire log di errore anche tramite le API?
i pulsanti e il resto ormai vanno messi tramite il tema... quella parte dovrebbe essere fatta da marco.

al limite posso aggiungere l'hook per fare in modo di aggiungere la preferenza sia al post che all'utente quando questi ci clicca sopra.
ACTION PREFERENZA

Ora avviene l'implementazione del gruppo e di come gli utenti possano comunicare tra di loro.




- parametri vuoti vengono ignorati (no errore)
- controllo origine , externalid 


Nei miei ultimi commit ho migliorato l'opzione "ExternalId" nella richiesta "search" di "Offers", che permette di "attaccare" a ciascuna offerta che matcha la search, le eventuali preferenze espresse dagli utenti elencati nella "ExternalId" (vedere documentazione o file di postman aggiornato).

 color: #3b5998
 &::before
     content: unquote("\"\\#{$icon-facebook2}\"")



prefer, errore su Publisher e togliere UserId
    offer: stessi del wall



in
foowd_theme

install-first di shell


git pull,

eventualmente merge

lavoro
git commit
git push



Stai usando plugin elgg e il profile?

volevo rifare la pagina profilo.

- dal profilo mandare all'elenco delle proprie offerte
- dal profilo andare alla pagina per cambiare i propri dati e immagini


akkuradbold


esterndere uservalidationbyemail/emailsent

curare i messaggi d'errore

status offerte

quali dati l'utente puo' modificare? ad esempio se offerente....

campo temp



1 - attivare e testare API con DB
2 - installare elgg
3 - copiare tutti i plugin e impostare i giusti permessi
4 - nei settings dei plugin impostare il giusto servizio API
5 - ora si puo' iniziare a usare



profile-gallery
id utente json con path relativo a offerImg


personalizzare gallery




rinominare OfferImg in FoowdStorage
php adjustTree.php in FoowdStorage
path:
use-..../
        /offers
        /profile
        /avatar

        {
            "ExternalId":"722"
        }


messaggi popup

php warning il foowd offerte in ogni single delle offerte


rimuovere page e css da default di foowd utility