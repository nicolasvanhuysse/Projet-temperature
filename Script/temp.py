#!/usr/bin/python
# -*- coding: utf-8 -*-
import time
import mysql.connector
import board
import busio
from adafruit_htu21d import HTU21D

i2c = busio.I2C(board.SCL, board.SDA)
sensor = HTU21D(i2c)


#Récupérer la date, l'heure, la température et l'humidité
date = time.strftime('%Y-%m-%d %H:%M',time.localtime())
print(date)

temperature = "\n%0.1f " % sensor.temperature
print(temperature)

humidite = "%0.1f " % sensor.relative_humidity
print(humidite)


#Connexion à la base myqsl

mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="nicolas",
    database="temperature"
)

mycursor = mydb.cursor()

#Insertion des données

#Boucle pour executer le script 50x
#i=0
#while i < 50:

sql = "INSERT INTO temp (date, temperature, humidite) VALUES (%s, %s, %s)"
val = (date, temperature, humidite)
mycursor.execute(sql, val)

mydb.commit()

print(mycursor.rowcount, "ligne insérer.")

#    i = i + 1
#    time.sleep(1)
