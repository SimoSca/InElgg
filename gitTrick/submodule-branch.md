# submodule-branch

spiega bene un'incomprensione relativa ai submodule e al fatto che non sono associati a una branch specifica.



### Stack Overflow URL
http://stackoverflow.com/questions/1777854/git-submodules-specify-a-branch-tag



# Contenuto:

Note: Git 1.8.2 added the possibility to track branches. See some of the answers below.

---

It's a little confusing to get used to this, but submodules are not on a branch. They are, like you say, just a pointer to a particular commit of the submodule's repository.

This means, when someone else checks out your repository, or pulls your code, and does git submodule update, the submodule is checked out to that particular commit.

This is great for a submodule that does not change often, because then everyone on the project can have the submodule at the same commit.

If you want to move the submodule to a particular tag:
````
cd submodule_directory
git checkout v1.0
cd ..
git add submodule_directory
git commit -m "moved submodule to v1.0"
git push
````

Then, another developer who wants to have submodule_directory changed to that tag, does this
````
git pull
git submodule update
````

git pull changes which commit their submodule directory points to.  git submodule update actually merges in the new code.