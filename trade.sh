#!/bin/bash
#Start shell script. You can add some startparameters if you want.
. direction.cfg
bash $direction/$1/steamcmd.sh +runscript csgous.txt
