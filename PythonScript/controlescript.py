#! /usr/bin/python

import os 
import re
import time
import subprocess
import sys 
import smtplib  


  
fromaddr = 'info@dingeneering.nl '  
toaddrs  = 'jeroen@dingeneering.nl'  

runonce=False
msg = """From: BaakKarrenmenglijn <storing@dingeneering.nl>
To: Storing melden <info@dingeneering.nl>
Subject: Er is een storing ontstaan.

Er is een storing bij baas
Einde bericht. 
"""
  
  
# Credentials   
username = 'info@dingeneering.nl'  
password = 'Jeroen2410' 




def findProcess():
    ps=subprocess.Popen("ps axf | grep in_db_check.py | grep -v grep", shell=True, stdout=subprocess.PIPE)
    output = ps.stdout.read()
    ps.stdout.close()
    ps.wait()
    return output
    
    
def isProcessRunning( processId):
    output = findProcess( processId )
    if re.search(processId, output) is None:
        return true
    else:
        return False



while True:
    time.sleep(10)
    print "process id ",findProcess()
    if re.search(findProcess(),findProcess() ) is None:
        print "proces draait"
    else:
        try: 
            server = smtplib.SMTP('smtp.hostnet.nl:587')  
            server.starttls()  
            server.login(username,password)  
            server.sendmail(fromaddr, toaddrs.split(","), msg)  
            server.quit() 
            print "succesvol een email verstuurd"
            time.sleep(5)
            #os.system("reboot")
            
        except smtplib.SMTPException:
            print "Error: unable to send email"
            #os.system("reboot")
        #print "proces draait"
