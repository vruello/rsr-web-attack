
#!/usr/bin/python
import MySQLdb
import time

flag6 = "flag6"



db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="superadmin",         # your username
                     passwd="superadminpassword",  # your password
                     db="Scenario1")        # name of the data base
db.autocommit(True)

cur = db.cursor()

def check():
    print "Checks if the grade has been changed"
    cur.execute("SELECT grade FROM grades WHERE id_classes = 1 and id_students = 4 LIMIT 1")

    result = cur.fetchall()
    for row in result:
        if (row[0] != 6):
            return True
        else:
            return False

    return False

def add_flag():
    print "Inserting the flag"
    cur.execute("INSERT INTO flags (flag) VALUES (%s)", (flag6,))
    db.commit()    
        

def loop():
    print "Launching the loop"
    while not check():
        time.sleep(2)

    add_flag()



loop()

db.close()
