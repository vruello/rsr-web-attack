## Serveur web

```bash
sudo apt install apache2 php libapache2-mod-php mysql-server php-mysql
sudo systemctl start apache2
sudo systemctl start mysql
```

## Installer le site

Copier le contenu du dossier dans `/var/www/html/`

## Droit d'accès en écriture pour upload les fichiers

```bash
#sudo chown www-data /var/www/html/RSR
#sudo chmod -R 755 /var/www/html/RSR
#sudo usermod -a -G www-data elfen

#sudo usermod -a -G www-data elfen
#sudo chmod -R g+w /var/www/html

sudo chown -R www-data:www-data /var/www/html
```

## Installer la BDD

```bash
sudo mysql
```

copier le contenu de `creation_base.sql` dans mysql, puis le contenu de `test.sql`.

## Module python

```python
sudo pip mysql-connector
```

## PhantomJS

Installer phantomjs (`http://phantomjs.org/download.html`).

## Launch

lancer `xss_request.py`.