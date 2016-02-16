#!/bin/bash
#Start shell script. You can add some startparameters if you want.
. direction.cfg
echo $1;
. $direction1/$1/config.cfg
#$runcsgo = "-usercon +game_type 0 +game_mode 0 +mapgroup mg_active +map de_dust2 +hostname "CSGOServer" +rcon_password "passwd"";
$exec;

#case "$1" in
#  1)
#    #screen -d -m -S "$2" "$direction"srcds_run -game csgo"$runcsgo";
#    echo "csgo";
#    ;;
#  3)
#     echo "Minecraft";
#     ;;
#  2)
#     echo "Teamspeak";
#     ;;
#esac
