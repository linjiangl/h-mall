#!/usr/bin/env bash

killall -9 php
rm -rf runtime/container
php ./bin/hyperf.php start &
