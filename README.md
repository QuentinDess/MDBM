# MyDataBaseMovies

# Intstallation

 Après avoir ajouter les dépendance avec un :

``` composer install ``` 
 
 Modifier la database url dans le .env pour configurer votre database:
 
 ``` DATABASE_URL=mysql://root:root@127.0.0.1:8889/MDBM ``` 

 Créez votre db 
 
 ``` doctrine:database:create  ``` 

 Executez les migration
 
 ``` symfony console doc:mak:mig ``` 

 Puis executer les fixtures
 
 ``` composer console doc:fixture:load ``` 

 Enjoy !
