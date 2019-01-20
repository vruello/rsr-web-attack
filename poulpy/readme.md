## Installation Guide
Python version : 2.7 ([Download](https://www.python.org/downloads/))

Framework  : Flask ([Documentation](http://flask.pocoo.org/docs/1.0/))

Windows packages Manager : Chocolatey ([Install](https://chocolatey.org/docs/installation))

### Flask Environment
Install Flask - Python Framework

    pip install flask

To locate Flask application, export FLASK_APP environment variable

    export FLASK_APP=app.py

Enter the following command in the project folder (where the app.py file is) to run the project

    python -m flask run

If your Python default version is not Python2.7, use:

    python2.7 -m flask run

### Database
Enter the following command in an admin cmd

	pip install flask-mysql
	choco install mysql -y
	pip install pymysql
	
To change the database location

	notepad "C:\tools\mysql\current\my.ini"
	
Start mySQL server / service
	
	mysqld

Create Database
	
	mysql -u root
	source database.sql

Database User

	User : Poulpy
	Password : poulpy2019
	
		
### Virtual Environment

> If an other python version is installed and the previous commands are not working, use these commands to overcome compatibility issues bewteen Python 2.7 and Flask

    ```
    cd poulpy
    virtualenv .
    source ./bin/activate
    flask --version
    ```

> Connect to : [http://127.0.0.1:5000/](http://127.0.0.1:5000/)