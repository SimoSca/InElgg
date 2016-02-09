
Comandi e check utili per Linux
===============================


Prompt Comandi
---------------

- trovare il path di un comando (composer ad esempio)
    + `type -a composer`

- fare in modo che uno script (ad esempio "composer") venga eseguito con sudo senza richiedere la password:
    + da root (su) runno il comando `visudo`
    + nel file che si apre imposto `enomis vps185945.ovh.net=(root) NOPASSWD:/usr/local/bin/composer`



MySql
-----

Eseguire backup completo, inclusi gli utenti e i loro permessi:

### mysqldump

#### comandi sperimentati e funzionanti:

- backup completo di tutti i database:
    
    `mysqldump -u root -pPASSWORD --events --lock-tables --all-databases > alldb.mysql`

di questi, il piu' importante e' il DB `mysql` , in particolare la tabella `user`, che contiene tutti gli utenti con i loro host e i permessi MySQL ivi impostati.

>NB: per sicurezza, dopo il salvataggio conviene controllare la dimensione del file, che non deve essere di zero

- restore di tutti i database:

    `mysql -u root -pkogamysql < alldb.mysql`


#### ricerche ed esiti generici

vedi [http://www.thegeekstuff.com/2008/09/backup-and-restore-mysql-database-using-mysqldump/](http://www.thegeekstuff.com/2008/09/backup-and-restore-mysql-database-using-mysqldump/)

    The database users/passwords/privileges are kept in the mysql database, and won't get dumped with your dump command. You'll have to add that database as well to the list of DBs to dump:
    
    mysqldump ... --routines --databases database_name mysql > backup.sql
    or just dump everything:
    
    mysqldump ... --routines --all-databases > backup.sql

    salvo solo la tabella utenti
    mysqldump -u root -p mysql user > UserTableBackup.sql


ripristino di un singolo database:

    mysql --database=miodb -u root -p < miodb.sql

ripristino di tutti i database presenti sul vecchio server:

    mysql -u root -p < tutti_i_database.sql



Some MySQL customers do not want to use the root user for mysqldump backups. For this user you have to grant the following minimal MySQL privileges:
    
    MYSQLDUMP --SINGLE-TRANSACTION (INNODB)
    CREATE USER 'backup'@'localhost' IDENTIFIED BY 'secret';
    GRANT SELECT, SHOW VIEW, RELOAD, REPLICATION CLIENT, EVENT, TRIGGER ON *.* TO 'backup'@'localhost';

    MYSQLDUMP --LOCK-ALL-TABLES (MYISAM)
    GRANT LOCK TABLES ON *.* TO 'backup'@'localhost';