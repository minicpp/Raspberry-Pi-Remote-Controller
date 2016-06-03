all:	test

test:	test.o
	gcc -o test test.o -lwiringPi -lpthread -lm

test.o: test.c
	gcc -c -O3 -Wall -Winline -pipe test.c -o test.o

clean:
	rm test.o test
