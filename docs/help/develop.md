### 开发环境

#### 配置启动服务

1. 创建shell script脚本
2. 配置`Script path:`路径，项目根目录`script/run/dev.sh`

#### docker环境配置`xdebug`

> 克隆项目

```shell script
$ git clone git@github.com:mabu233/sdebug.git
```

> 进入docker容器下操作

```shell script
$ cd /hyperf-skeleton/sdebug
$ chmod +x rebuild.sh
# 设置alpine源
$ sed -i 's/dl-cdn.alpinelinux.org/mirrors.aliyun.com/g' /etc/apk/repositories
# 安装linux基础命令
$ apk add --update util-linux vim
# 安装phpize,php-config
$ apk add phpize_devs php7-dev
$ ln -s /usr/bin/phpize7 /usr/bin/phpize
$ ln -s /usr/bin/php-config7 /usr/bin/php-config
$ ./rebuild.sh
# 配置php.ini
$ echo 'zend_extension="xdebug.so"' >> /etc/php7/php.ini
# 查看phpinfo信息
$ php -v
PHP 7.3.10 (cli) (built: Oct 10 2019 21:36:56) ( NTS )
Copyright (c) 1997-2018 The PHP Group
Zend Engine v3.3.10, Copyright (c) 1998-2018 Zend Technologies
    with Sdebug v2.7.3-dev, Copyright (c) 2002-2019, by Derick Rethans
```
