#!/bin/bash
LOG="/var/www/log/gpio.log"
EMIT_NUM_SWITCH=5
EMIT_NUM=20
DELAY=15

echo 'Begin to write PIN 4, which is GPIO 4'
echo "[$(date)] Begin PID-$$" >> $LOG
gpio mode 4 out
if [ "$1" != "" ]; then
	echo "[$(date)] Delay $1" >> $LOG
	sleep $1
	echo "[$(date)] End of delay" >> $LOG
else
	echo "[$(date)] No delay" >> $LOG
fi

if [ $2 -eq 0 ]; then
	echo "Switch 0" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM_SWITCH $DELAY
elif [ $2 -eq 1 ]; then
	echo "Switch 1" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
elif [ $2 -eq 2 ]; then
	echo "Switch 2" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
elif [ $2 -eq 3 ]; then
	echo "Switch 3" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
elif [ $2 -eq 4 ]; then
	echo "Switch 4" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
elif [ $2 -eq 5 ]; then
	echo "Switch 5" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
elif [ $2 -eq 6 ]; then
	echo "Switch 6" >> $LOG
	sudo ./runoutlet $2 $EMIT_NUM $DELAY
else
	echo "Unknow Code $2" >> $LOG
fi

echo 'End to write PIN 4'
echo "[$(date)] End of the process PID-$$" >> $LOG
echo '' >> $LOG
