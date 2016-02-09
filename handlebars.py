from os import listdir
from os.path import isfile, join

mypath = 'C:\\xampp\\htdocs\\www\\ElggProject\\foowd_alpha2\\mod_elgg\\foowd_theme\\pages\\templates\\'
myext = '.handlebars'
mydest = '"' + mypath + 'templates-amd.js' + '"'

# creo l'array
f = []

for file in listdir(mypath):
    if file.endswith( myext ):
        f.append( '"' + join(mypath, file) + '"' )

mysources = ' '.join( f )


mycmd = 'handlebars ' + mysources + ' -f ' + mydest + ' --amd'

print('Comando da eseguire:')
print(mycmd)

import os
os.system(mycmd)