#!/bin/bash
echo "loading..."
pid=`pidof live_master`
echo $pid
`kill -USR1 26937`
#echo "loading success"