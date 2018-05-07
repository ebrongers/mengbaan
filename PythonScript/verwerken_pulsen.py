#! /usr/bin/python
# -*- coding: utf-8 -*-

import time
import MySQLdb as mdb
import sys
import wiringpi
import time
import pifacedigitalio as p 
p.init()


#io = wiringpi.GPIO(wiringpi.GPIO.WPI_MODE_PINS)

#io.pinMode(0,io.INPUT)
#io.pinMode(1,io.INPUT)
#io.pinMode(2,io.INPUT)
#io.pinMode(4,io.OUTPUT)
teller=0
runonce=0
DebounceTeller=0

# status 1 = verwerkt
# status 2 = bezig met verwerken. 
# status 3 = nog te verwerken. 
# status 4 = prioriteit 
 
con = mdb.connect('localhost', 'pi', '', 'baaskarrendb'); 
cur = con.cursor() 


 
while True:

   if p.digital_read(0)== True: 
		time.sleep(0.5)
		DebounceTeller += 1
		if runonce ==0 and DebounceTeller ==2 :
			runonce =1
			DebounceTeller =0
			print "teller is hoog "
			with con: 
				p.digital_write(7,1)
				cur.execute("SELECT verwerkt FROM opdrachten WHERE status='2'  LIMIT 1") #waarde van de verwerkte aantallen uit de Database halen 
				try:
					teller = cur.fetchone()[0] # casten naar int 
					teller +=1		# er een bij optellen
					print teller
					cur.execute("UPDATE opdrachten SET verwerkt=%s WHERE status='2' LIMIT 1 " % (teller)) # waarde wegschrijven naar de Database
					
					cur.execute("SELECT orderaantal FROM opdrachten WHERE status='2'  LIMIT 1") # ophalen van het totaal te verwerken opdrachten. 
					orderaantal = cur.fetchone()[0]
					print orderaantal
									
					if teller ==orderaantal : # kijken of de totaal aantal opdrachten berijkt is. 
						print "zijn gelijk "
						cur.execute("UPDATE opdrachten SET status=1 WHERE status='2' LIMIT 1") # wisselen van opdracht!!!	
						
						cur.execute("SELECT orderid FROM opdrachten WHERE status='4'  LIMIT 1") # kijken of er een opracht is met prioritijd 
						try:
							prioid = cur.fetchone()[0]
							if prioid > 0 :
								print "er is één opracht met prioritijd"
								print prioid
								#cur.execute("UPDATE opdrachten SET status=2 WHERE status='4' LIMIT 1")
								
						except: 	
							print "geen opdracht met prioritijd"
							#cur.execute("UPDATE opdrachten SET status=2 WHERE status='3' ORDER BY volgorder LIMIT 1") 		
							print "gewone opdracht van prio 3 naar 2 "
				except:
					#cur.execute("UPDATE opdrachten SET status=2 WHERE status='3' ORDER BY volgorder LIMIT 1")  	
					try: print "er zijn geen opdrachten"
					except: print "Error in update van status 3 naar 2"
						
				
   else:
		p.digital_write(7,0)
		p.digital_write(6,1)
		runonce = 0
		DebounceTeller=0
		time.sleep(0.5)
		p.digital_write(6,0)

		