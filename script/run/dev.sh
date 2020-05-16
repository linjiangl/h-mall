#!/usr/bin/env bash

docker exec dhyperf bash -c "killall -9 php
cd /hyperf-skeleton/h-mall && rm -rf runtime/container && php ./bin/hyperf.php start"
