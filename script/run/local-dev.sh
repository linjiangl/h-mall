#!/usr/bin/env bash

# HMall => .env APP_NAME=HMall
# ps -ef | grep HMall | awk '{print $1}' | xargs kill -9
killall -9 php
rm -rf runtime/container
php ./bin/hyperf.php start &
