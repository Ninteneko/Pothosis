# ***Pothosis Project***
# OBJECTIVE:
# Pothosis is a system that checks the Soil moisture levels of plants and waters them depending on the value.
# The system also checks the temperature and humidity. This is then compared to the ideal values and displayed
# on webpage. The webpage notifies the user what condition the plant is based on the values
# MODIFIED BY: Charles Vosguanian & Yarelit Mendoza

import serial
import string
import time
import Adafruit_DHT

DHT_SENSOR = Adafruit_DHT.DHT11
DHT_PIN = 4

# Utilizing a DHT11, this function obtains the etemperature and humidity values.
# returns values as a string for data storing
def tempHumid():
	repeat = True
	string = ""
	while repeat:
		humidity, temperature = Adafruit_DHT.read(DHT_SENSOR, DHT_PIN)
		if humidity is not None and temperature is not None:
			string = "Temperature is {0:0.1f}C & Humidity is {1:0.1f}%".format(temperature, humidity)
			repeat = False
		else:
			continue
	return string

# Copies the data into a .txt file. These files are then accessed by the webpage
def copyData(data, file):
	textFile = "/var/www/html/" + file
	file = open(textFile, "w")
	file.write(data)
	file.close()

def waterPlant():
	return None

# Continuously gathers the values returned by the arduino and stores it in a file
# If the moisture is below a threshold, the watering process will take place.
if __name__ == '__main__':
	ser = serial.Serial('/dev/ttyACM0',9600, timeout=1)
	ser.flush()

	while True:
		line = ser.readline().decode('utf').rstrip()
		copyData(line, "data.txt")

		num = int(line[0:2])

		temp = str(tempHumid())
		copyData(temp, "humidity.txt")
		print(temp)

		if num < 20:
			# watering will take place here!
			print("water plant")
		else:
			print("Plant is healthy at:", num,"%")
		print()
		time.sleep(2)
