#!/bin/bash
#Start shell script. You can add some startparameters if you want.
. dire.cfg
screen -d -m -S csgoretake "$direction"srcds_run -game csgo -usercon +game_type 0 +game_mode 0 +mapgroup mg_active +map de_dust2 -tickrate 128 -exec autoexec.cfg +hostname "CSGOServer" +rcon_password "passwd" +mp_solid_teamates 1
