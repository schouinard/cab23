# cab23

## Requirements
 * Git
 * Composer
 * Vagrant
## Installation

```
$ git clone https://github.com/schouinard/cab23
$ cd cab23
$ cp Homestead.yaml.example Homestead.yaml
``` 

 * Ajuster le fichier Homestead.yaml pour les sections folders et sites
 * Ajuster le fichier /etc/hosts en indiquant le même ip et le même host que dans le Homestead.yaml
 
  ```
  192.168.10.10  cab23.app
  ```
  
  * Démarrer la vagrant
  
  ```
  $ vagrant up
  ```
  
  * Vous pouvez ajouter ceci à votre fichier .ssh/config si vous voulez gagner du temps:
  
  ```
  # Homestead
  Host homestead
  HostName 127.0.0.1
  Port 2222
  User vagrant
  ```
  
  * Vous pouvez ensuite accéder à votre vagrant en utilisant le raccourci
  ```
  $ ssh homestead
  ```
  * Allez ensuite dans le répertoire du projet
  
```
$ cd Code/cab23
$ composer install
$ npm install
```

Et c'est ça qui est ça.
  
  
