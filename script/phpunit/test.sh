#!/usr/bin/env bash

docker exec dhyperf bash -c "
cd /hyperf-skeleton/h-mall
rm -rf runtime/container
bin/hyperf.php migrate:fresh --seed
vendor/bin/co-phpunit -c phpunit.xml --colors=always"
