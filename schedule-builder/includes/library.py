import pymysql

host = 'localhost'
username= 'root'
password=''
dbName = 'scheduling_website'

conn = pymysql.connect(host, username, password, dbName)
cursor = conn.cursor()
conn.close()