"""
Midori Kiosk Reloader.
Created by xxmbabanexx
    
NOTE: This program opens Midori automatically. DO NOT OPEN IT MANUALLY, SIMPLY CLICK ON THIS PROGRAM.
     
KEYS
     
1 = Connection Complete. All is well.
    
0 = Connection Incomplete. Something is wrong.
"""
     
     
#Change these variables to your liking.
    
host = "www.google.com" #(www.google.com)Put your desired host URL/IP between the quotes
port = 80 #Set to default port of 80. If your host uses something else, please change it.
recheck_time = 10 #The number of seconds the program will wait to ping the server. Change this at your leisure.
page_to_open_to = "127.0.0.1/view.php" #(www.google.com))This is the webpage the kiosk will open to. Put the url between the quotes.
     
     
#Excersise caution when changing these vars.
  
last = -1 #undefined state
up = -1 #Undefined state
     
     
     
"""
#---------------- Main code. Do NOT touch unless you KNOW what you are doing. ------------
"""
#Import modules
     
import subprocess as sub
from time import sleep
import socket
import threading
     
sub.Popen(["midori", "-e","Fullscreen","-a", page_to_open_to]) #open midori
     
     
#Check if internet is up
addr = (host, port) #the connection addr
     
     
while True:
    last = up #reset checking var
    s = socket.socket(socket.AF_INET, socket.SOCK_STREAM) #create socket
    try: #attempt to ping, change vars
        s.connect(addr)
        up = 1
        print "\n"
    except socket.error: #if error when pinging, change vars
        up = 0
        print "\n"
           
    print "LAST CHECK:", last
    print "CURRENT CHECK:", up
    if last == 0 and up == 1:
        print "Reloading Midori.\n"
        #sub.call(["midori", "-e", "Reload"]) 07-12-13 weg gehaald 
    s.close()
    #up = 0 #bijgemaakt zodat hij om de recheck_time x sec gaat reloaden 06-10-13
    sleep(recheck_time)

