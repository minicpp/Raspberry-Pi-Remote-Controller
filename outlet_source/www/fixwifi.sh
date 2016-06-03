#!/bin/bash
MY_WIFI_ID='C6E2'
count=0
fix_count=0
times_log=60
LOG="/var/www/log/wifi.log"
wait_seconds=60

echo '' >> $LOG
echo "[$(date)] Script Begin" >> $LOG
while :
do
	sleep $wait_seconds
	output=$(iwconfig wlan0 | grep $MY_WIFI_ID)
	if [[ -z $output ]]; then
		# we do not find the wifi id
		fix_count=$((fix_count+1))
		count=0
		echo '' >> $LOG
		echo "[$(date)] Fix $fix_count" >> $LOG
		echo 'ifdown' >> $LOG
		ifdown  wlan0 >> $LOG 2>>$LOG
		sleep 5
		echo 'ifup' >> $LOG
		ifup  wlan0 >> $LOG 2>>$LOG
		sleep 10
		output=$(iwconfig wlan0 | grep $MY_WIFI_ID)
	
		if [[ -z $output ]]; then
			echo "[$(date)] Fix again by force" >> $LOG
			#echo 'ifdown' >> $LOG
			#ifdown --force wlan0 >>$LOG 2>>$LOG
			#sleep 15
			echo 'ifup' >> $LOG
			ifup --force wlan0 >>$LOG 2>>$LOG
		fi	
		echo "[$(date)] Fix finish" >>$LOG
	else
		# we find the wifi id
		count=$((count+1))

		if (( $count == times_log )); then
			count=0
			echo "[$(date)] Regular checkpoint" >> $LOG
		fi

	fi
done
