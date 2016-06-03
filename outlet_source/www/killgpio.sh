#!/bin/bash
LOG="/var/www/log/gpio.log"
if [ "$1" != "" ]; then
	echo ''>>$LOG
	echo "[$(date)] kill -9 $1" >> $LOG
	kill -9 $1 >> $LOG 2>>$LOG
	echo ''>>$LOG
fi
