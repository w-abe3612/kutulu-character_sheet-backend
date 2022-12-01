#!/bin/sh
 
FILE=".test"
cd ./app
 
if [ -e $FILE ]; then
  rm FILE
fi

touch FILE