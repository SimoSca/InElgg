BUG
===

bloccare la preferenza per 24h (status blocked) e poi passare a status solved.
Ma in queste 24h l'utente non può assolutamente fare nulla, o se decide di esprimere la preferenza allora ne crea una nuova che finirà sull'ordine successivo?
In caso di blocco si potrebbe mettere da frontEnd un if status == blocked allora messaggio: "Questo prodotto fa parte di un ordine e non può essere modificato. Dopo aver ricevuto una mail di conferma di tale ordine potrai esprimere nuove preferenze su tale prodotto".

x marco

ho rinominato il file in PurchaseMessageMail.php per renderlo piu associabile al suo utilizzo, inoltre per evitare incomprensioni il riepilogo dei singoli ordini da inviare al leader l'ho rinominato managerSingleOrderSummaryMsg .
Il file risulta leggermente modificato perche' ho corretto un errorino, ma l'essenza non cambia.

Per mia abitudine ho commetato tutte le funzioni non utilizzate, in modo da rendere piu facile rintracciare solo quelle di nostro interesse.

x davide

Dopo aver svolto l'ordine, i parametri sono a zero, pertanto se il responso della action foowd-purchase-leader e' positivo la preferenza risulta ora bloccata

prefer.prefers = 'locked'
prefer.State = 'pending'

controllo totalQt:
per il momento ho impostato il fatto che la Qt di una singola preferenza possa al massimo eguagliare la maxQt dell'offerta, ma come facciamo per l'ordinazione del gruppo? voglio dire, la somma sulle preferenze degli amici a quel punto potrebbe superare la maxQt, pertanto vorrei sapere come fare...
In ogni caso al momento dell'ordinazione questo parametro andrebbe controllato. Lato API ho inserito un controllo che non realizza l'ordinazione e che ritorna un errore qualora l'ordinazione superi la maxQt.

Altro controllo lato API:
l'ordinazione non puo' partire se la data attuale supera la data di scadenza dell'ordine.
Questo controllo lo uso anche sulle singole preferenze?


evitare canvellazione di foowd_utility/js/utility.settings.amd.js
vendor/.git






