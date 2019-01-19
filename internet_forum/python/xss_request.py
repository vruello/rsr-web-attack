import mysql.connector
import os
import time

def reported_posts():
  topics_id = []
  mydb = mysql.connector.connect(
    host="localhost",
    user="rsrwebsite",
    passwd="teamwebrsr2018",
    database="RSRWebsite"
  )
  mycursor = mydb.cursor()
  mycursor.execute("SELECT id_post_topic FROM posts WHERE reported = true")
  myresult = mycursor.fetchall()

  for topic in myresult:
    topics_id.append(topic[0])

  topics_id = list(set(topics_id))
  
  return topics_id

def check_topics(topics_id):
  command_base = "/var/www/html/RSR/phantomjs/bin/phantomjs /var/www/html/RSR/js/xss.js "
  #command_base = "/home/elfen/Documents/phantomjs/bin/phantomjs /var/www/html/RSR/js/xss.js "
  command = ""
  for id_topic in topics_id:
    command = command_base + str(id_topic)
    os.system(command)

while 1:
  topics_id = reported_posts()
  check_topics(topics_id)
  time.sleep(5)

