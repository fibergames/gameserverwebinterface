#!/bin/bash
#this tries to update the server. You need the csgous.txt
#example for csgo.txt
#login anonymous
#force_install_dir /home/csgohome/steamcmd/csgo/ (game path)
#app_update 740
#quit
#
#of course you have to remove the hashtags :)
. dire.cfg
screen -d -m -S csupdate bash "$direction2"steamcmd.sh +runscript csgous.txt
