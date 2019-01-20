# !/usr/bin/python
# -*- coding: utf-8 -*-
__author__ = "Camille El-Habr"
__copyright__ = "Copyright 2019 - Poulpy RSR"
__credits__ = ["Camille El-Habr"]
__version__ = "1.0"
__maintainer__ = "Camille El-Habr"
__email__ = "camille.el-habr@enseirb-matmeca.fr"
__status__ = "Prototype"
__description__ = 'Poulpy main program with paths'

from flask import *
from functions import *
import pprint
import hashlib
import pymysql

app = Flask(__name__)
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'poulpy'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'
app.config['MYSQL_DATABASE_PORT'] = 3306
pp = pprint.PrettyPrinter(indent=4)

authentification_number = random_number()
challenge = None


def getCursor():
    conn = pymysql.connect(host=app.config['MYSQL_DATABASE_HOST'],
                           port=app.config['MYSQL_DATABASE_PORT'],
                           user=app.config['MYSQL_DATABASE_USER'],
                           database=app.config['MYSQL_DATABASE_DB'])

    return conn.cursor()


def getConn():
    return pymysql.connect(host=app.config['MYSQL_DATABASE_HOST'],
                           port=app.config['MYSQL_DATABASE_PORT'],
                           user=app.config['MYSQL_DATABASE_USER'],
                           database=app.config['MYSQL_DATABASE_DB'])


@app.route("/", methods=['GET'])
def index():
    if not session.get('logged_in'):
        return render_template('index.html')
    else:
        return redirect(url_for('trade'))


@app.route("/login", methods=['GET', 'POST'])
def login():
    if request.method == 'GET':
        return redirect(url_for('index'))
    else:
        login = request.form['login']
        password = request.form['password']
        factor = request.form['factor']

        m = hashlib.md5()
        m.update(password)

        cursor = getCursor()
        cursor.execute("SELECT * FROM users WHERE login = '" + login + "'")
        response = cursor.fetchall()

        if response is None or not response:
            return redirect(url_for('index'))
        else:
            hash = find_password(response, login)
            if hash == m.hexdigest():
                global authentification_number
                if factor == "1234":  # str(authentification_number):
                    session['logged_in'] = True
                    session['user'] = login
                    retour = current_app.make_response(redirect('/trade'))
                    retour.delete_cookie('pass')
                    return retour
                else:
                    return redirect(url_for('index'))
            else:
                retour = current_app.make_response(redirect('/'))
                retour.set_cookie('pass', value=str(response))
                return retour


@app.route("/logout", methods=['GET'])
def logout():
    session['logged_in'] = False
    session['user'] = ""
    return redirect(url_for('index'))


@app.route("/trade", methods=['GET'])
def trade():
    if not session.get('logged_in'):
        return redirect(url_for('index'))
    else:
        cursor = getCursor()
        cursor.execute("SELECT * FROM currencies")
        currencies = cursor.fetchall()

        cursor.execute("SELECT wallet FROM users_wallet WHERE login = '" + session['user'] + "'")
        param = cursor.fetchone()

        cursor.execute("SELECT * FROM wallet WHERE number = '" + param[0] + "'")
        wallet = cursor.fetchall()

        heritage = total_heritage(currencies, wallet[0])

        cursor.execute("SELECT * FROM ledger")
        ledgers = cursor.fetchall()
        return render_template('trade.html', currencies=currencies, wallet=wallet[0], total=heritage, ledgers=ledgers)


@app.route("/funding", methods=['GET'])
def funding():
    if not session.get('logged_in'):
        return redirect(url_for('index'))
    else:
        cursor = getCursor()
        cursor.execute("SELECT wallet FROM users_wallet WHERE login = '" + session['user'] + "'")
        param = cursor.fetchone()

        return render_template('funding.html', wallet=param[0], maxUserBTC=getBTCByWallet(getWalletByUser(session['user'])), challenge=challenge)


@app.route("/withdraw", methods=['GET', 'POST'])
def withdraw():
    if not session.get('logged_in'):
        return redirect(url_for('index'))
    else:
        cursor = getCursor()
        cursor.execute("SELECT wallet FROM users_wallet WHERE login = '" + session['user'] + "'")
        param = cursor.fetchone()
        return render_template('withdraw.html', wallet=param[0], messages=getMessagesByUser(session['user']))


@app.route("/security", methods=['POST'])
def security():
    param = random_number()
    global authentification_number
    authentification_number = param
    return render_template('security.html', number=param)


@app.route("/getBTCByWallet", methods=['POST'])
@app.route("/getBTCByWallet/<wallet>", methods=['GET'])
def getBTCByWallet(walletParam=None):
    wallet = unicodeToString(request.form['wallet']) if walletParam is None else walletParam

    cursor = getCursor()
    sql = "SELECT XBT FROM wallet WHERE number = %s"
    cursor.execute(sql, (wallet,))

    return fetchOne(cursor)


def fetchOne(cursor):
    res = [seq[0] for seq in cursor.fetchall()]

    # json pour return correctement selon Flask, repr pour float to str (que si non str)
    return json.dumps(False) if len(res) == 0 else (res[0] if isinstance(res[0], basestring) else repr(res[0]))


def getWalletByUser(user):
    cursor = getCursor()
    sql = "SELECT wallet FROM users_wallet WHERE login = %s"
    cursor.execute(sql, (user,))

    return fetchOne(cursor)


def getUserByWallet(wallet):
    cursor = getCursor()
    sql = "SELECT login FROM users_wallet WHERE wallet = %s"
    cursor.execute(sql, (wallet,))

    return fetchOne(cursor)


def getMessagesByUser(user):
    cursor = getCursor()
    sql = "SELECT amount, emeteur, message FROM message WHERE recepteur = %s"
    cursor.execute(sql, (user,))

    return cursor.fetchall()


@app.route("/transfert", methods=['GET', 'POST'])
def transfert():
    data = request.form

    sender = getWalletByUser(session['user'])
    receiver = unicodeToString(data['receiver'])

    try:
        amount = float(unicodeToString(data['amount']))
    except ValueError:
        amount = 0.0

    # Pas / Mauvais wallet renseigné : possible de rajouter un flash plutot que juste redirect
    try:
        currentSenderAmount = float(getBTCByWallet(sender))
        currentReceiverAmount = float(getBTCByWallet(receiver))
    except ValueError:
        return redirect(url_for('funding'))

    cursor = getCursor()
    cursor.execute("UPDATE wallet SET XBT = " + repr(currentSenderAmount - amount) + " WHERE number = '" + sender + "'")
    cursor.execute("UPDATE wallet SET XBT = " + repr(currentReceiverAmount + amount) + " WHERE number = '" + receiver + "'")

    if data.has_key('message'):
        cursor.execute("INSERT INTO message values ('" + getUserByWallet(sender) + "', '" + getUserByWallet(receiver) + "', '" + unicodeToString(data['message']) + "')")

    cursor.connection.commit()

    global challenge
    challenge = check_challenge(receiver, sender)

    return redirect(url_for('funding'))


@app.route("/sendMessage", methods=['GET', 'POST'])
def sendMessage():
    data = request.form
    sender = getWalletByUser(session['user'])
    receiver = unicodeToString(data['receiver'])
    amount = float(unicodeToString(data['amount']))
    message = data['message']

    re = "INSERT INTO message values ('" + getUserByWallet(sender) + "', '" + getUserByWallet(receiver) + "', '" + repr(amount) + "', '" + message + "')"
    print(re)
    cursor = getCursor()
    cursor.execute(re)

    cursor.connection.commit()

    return redirect(url_for('withdraw'))

@app.route("/getFactor", methods=['POST'])
def getFactor():
    global authentification_number
    return authentification_number

if __name__ == "__main__":
    app.secret_key = 'poulpySecret2019'
    app.run(host='0.0.0.0', port=5000)
