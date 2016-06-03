#include <stdio.h> 
#include <stdlib.h>
#include <wiringPi.h> 

int g_signal_switch[]=
	{1,0,1,0,1,0,1,0,1,0,0,1,1,0,1,1,0,1,1,0,0,1,0,0,0};

int g_signal_1_open[]=
	{0,1,1,0,1,0,0,0,1,0,0,0,0,0,0,0};

int g_signal_1_close[]=	
	{0,1,1,0,1,0,0,0,0,1,0,0,0,0,0,0};

int g_signal_2_open[]=
	{0,1,1,0,1,0,0,0,0,0,1,0,0,0,0,0};

int g_signal_2_close[]=
	{0,1,1,0,1,0,0,0,0,0,0,1,0,0,0,0};

int g_signal_3_open[]=
	{0,1,1,0,1,0,0,1,0,0,0,0,0,0,0,0};

int g_signal_3_close[]=
	{0,1,1,0,1,0,1,0,0,0,0,0,0,0,0,0};

#define PIN 4
#define DELAY	10000
#define SEND_LOW_SWITCH	digitalWrite(PIN,1);delayMicroseconds(600);	\
			digitalWrite(PIN,0);delayMicroseconds(1200);
#define SEND_HIGH_SWITCH	digitalWrite(PIN,1);delayMicroseconds(1200);	\
				digitalWrite(PIN,0);delayMicroseconds(600);
#define SEND_LOW_SIGNAL	digitalWrite(PIN,1);delayMicroseconds(600);	\
			digitalWrite(PIN,0);delayMicroseconds(1800);
#define SEND_HIGH_SIGNAL	digitalWrite(PIN,1);delayMicroseconds(1800);	\
				digitalWrite(PIN,0);delayMicroseconds(600);
int emitSignal(int s){
	int *pv=0;
	int i=0;
	int size=0;
	if(s == 0){
		size = sizeof(g_signal_switch)/sizeof(int);
		pv = g_signal_switch;
	}
	else{
		size = 16;
		switch(s)
		{
			case 1:
				pv = g_signal_1_open;
				break;
			case 2:
				pv = g_signal_1_close;
				break;
			case 3:
				pv = g_signal_2_open;
				break;
			case 4:
				pv = g_signal_2_close;
				break;
			case 5:
				pv = g_signal_3_open;
				break;
			case 6:
				pv = g_signal_3_close;
				break;
		}
	}

	if(s == 0)
	{
		for(i=0; i<size; ++i,++pv){
			if(*pv == 0){
				SEND_LOW_SWITCH
			}
			else{
				SEND_HIGH_SWITCH
			}
		}
		
		return 0;
	}
	for(i=0; i<size; ++i,++pv)
	{
		if(*pv==0)
		{
			SEND_LOW_SIGNAL
		}
		else
		{
			SEND_HIGH_SIGNAL
		}
	}
			
	return 0;
}

int main(int argc, char *argv[])
{
	int i=7;
	int s=0;
	int m=10;
	printf("Begin %d\n", argc);

	if(argc != 4){
		printf("Help: command [0-6 for outlet index] [hitting times in batch] [delay for each batch(ms),usually >= 10ms]\n");
		return 0;
	}
	else{
		s = atoi(argv[1]);
		i = atoi(argv[2]);
		m = atoi(argv[3]);
	}
	if(wiringPiSetup() == -1)
		return 1;
	if(piHiPri(99) == -1){
		printf("Promote Priority Failed.\n");
		return 1;
	}
	pinMode(PIN, OUTPUT);
	digitalWrite(PIN, 0);
	
	while(i--)
	{
		emitSignal(s);
		delayMicroseconds(m*1000);
	}
	printf("End\n");
	return 0;
}
