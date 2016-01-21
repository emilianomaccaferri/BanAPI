# BanAPI
=======
This Rest API helps you to manage your Minecraft server's bans!

#How does it work?
By simply making a request to your website, this API can register, remove and read banned players.
It creates a file for each player you insert and retrives infos from there.
You will be provided of a secure ID at the first run of the API (or if the config.json file is missing).

**REMEMBER TO MAKE THE /data FOLDER NON-ACCESSIBLE**

#Create a ban
If you want to create a ban, the "syntax" is simple: `http://yourdomain.com/insert/player/date/reason/yourID`.

#Remove a ban
If you want to remove a ban, simply access to: `http://yourdomain.com/remove/player/yourID`.

#Read all the bans
To read all the bans, simply access to: `http://yourdomain.com/readall/yourID`.

#Read a single ban
To read a single ban, simply access to: `https://yourdomain.com/read/name/yourID`
