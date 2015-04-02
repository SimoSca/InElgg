AVVISO!
=======

Do not rebase commits that exist outside your repository!!!!

Se tratti la rifondazione com un modo per essere pulito e lavorare con i commit prima di inviarli, e se fai il rebase solamente dei commit che non sono mai diventati pubblici, allora la cosa è ok. Se fai il rebase dei commit che sono già stati inviati e sono pubblici, e le persone hanno basato il loro lavoro su questi commit, allora potresti creare dei problemi di frustazione.

Comandi Utili
=============

- creo un ramo di nome iss, poi mi ci sposto dentro
    
    git branch iss
    git checkout iss

- vedo i banches remoti
    ````bash
    git branch -r
    ````
- aggiorno il puntatore remoto, MA SENZA CAMBIARE LA BRANCH LOCALE
    
    git fetch

- se voglio vedere le differenze tra master e origin/master, allora
    
    git diff master origin/master

- se sono su master, dopo aver fatto un git fetch, posso unire la mia master (il branch su cui sono) con la remota (origin)
    
    git merge origin/master

- se voglio inserire i cambiamenti di experimental nel remoto origin 

    *(se torna degli errori, probabilmente qualcuno ha pushato dalla mia ultima modifica, e quindi devo fare prima fetch e merge di origin)*

    git push origin experimental

- ispeziono la origin

    git remote show origin

- visualizzare il log in maniera comoda

    git log --oneline --decorate --graph --all

- visualizzare branch che contengono lavoro non ancora mergiato
    git branch --no-merged

- rimuovere dall'area di stage una directory intera
    git reset <directory>


# Mia procedura:

1. sulla mia issue, diciamo *iss12*, eseguo i vari add, remove e commit
2. torno al master: git checkout master
3. fondo il master con *iss12* : git merge iss12
4. eventualmente posso visualizzare le differenze tra master e iss12: git diff master iss12
5. Eventualmente potrei eseguire un rebase, ma dato che attualmente la iss12 potrebbe ancora essere da implementare, aspetto.
6. eseguo un fetch dell'origine: git fetch
7. eventualmente faccio il merge tra il master locale e l'origin
8. faccio un push dei miei cambiamenti inserendoli nella remota: git push 
    
    nota che i miei commit compaiono tra quelli del repo remoto.


# Cancellare PUSH

nel caso faccia un push al repo remoto, posso dare i seguenti comandi:
(HEAD~{1} if you know you need to reverse exactly one commit.)

$ git reset --hard <revision_id_of_last_known_good_commit>
$ git push --force

pero' fare attenzione: questo resetta anche i files locali all'ultimo commit... e' praticamente un checkout, dunque WARNING!


Gestire Account
===============

devo fare attenzione a quali e quanti account ho impostato, onde evitare di eseguire commit con account sbagliati.

- controllo la configurazione globale
    + git config --global --list

- rimuovo una sezione globale
    + git config --global --remove-section user.name

- unsetto di tutti gli user.name
    + git config --global --unset-all user.name

- imposto a tutti lo user.name
    + git config --global --replace-all user.name "New User Name"

- per visualizzare ed editare il file config *(in C:\Users\MyLogin\.gitconfig)*:
    + git config --global --edit

- il comando --local e' il default al posto di global, di conseguenza scrivere
    + git config user.name "whatf hobbyist"
    
    mentre sono in un repo, equivale a salvare localmente i dati in quel repo. 

    In particolare posso trovare tali dati in **.git/config** di quel repo.

- se voglio visualizzare tutti i dati di user
    + git config --get-regexp user

Per ulteriori dettagli vedere anche https://help.github.com/articles/setting-your-username-in-git/


Multiple Branch per Multi Manage
=================================

https://www.atlassian.com/git/tutorials/comparing-workflows/gitflow-workflow/

git remote add infoowd https://github.com/SimoSca/InFoowd.git
pusho miaBranch in infoowd:
git push -u infoowd miaBranch

per il -u vedere tracking branch in http://git-scm.com/book/it/v2/Git-Branching-Remote-Branches

#### Aggiungo progetto con Moduli esterni

1. avendo gia' la directory preparata, eseguo
    ````
    git remote add origin https://github.com/SimoSca/InElgg.git
    git push -u origin master
    ````

1. sul pc di supporto, in **htdocs/** uso `git clone https://github.com/SimoSca/InElgg.git`, e cosi' creo la directory **InElgg**
2. creo il submodulo scaricandolo nella directory **foowd_alpha2**, grazie al comando `git submodule add https://github.com/SimoSca/InFoowd.git foowd_alpha2`
    dopo controllo con git status che sia stato greato il file .gitsubmodule e la directory, e faccio un commit, esempio
    ````
    git commit -am 'aggiunto submodulo infoowd nella directory foowd_alpha2'
    ````
    in ultimo pusho
3. su uno dei due repo, per praticita', creo un branch isolato che utilizzero' per svolgere commit giornalieri e personali, eseguendo:
    ````
    git checkout -b simone-daily master
    ````

    eseguo qualche lavoro e poi pusho, la prima volta col comando
    ````
    git push -u origin simone-daily
    ````


`git branch -vv`, per visualizzare i branch ed i relativi upstream
`git push origin :<branchName>` per rimuovere il ramo remoto

`git push infoowd master` per pushare master nel repo remoto infoowd