#INJECTIONS SQL

##Installation

```bash
#Installation de mysql
sudo apt install mysql-server
```

##Utilisation

```bash
#Démarrer le serveur
sudo systemctl start mysql
#Lancer la console mysql
sudo mysql

#Selectionner la base de données
use injection1

#Création de deux users
CREATE USER 'user1' IDENTIFIED WITH mysql_native_password BY 'mot_de_passe_solide';
CREATE USER 'admin' IDENTIFIED WITH mysql_native_password BY 'mot_de_passe_solide';



#Recherger le serveur
sudo systemctl reload mysql
#Arreter le serveur
sudo systemctl stop mysql
```