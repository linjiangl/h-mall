### 开发环境

#### 配置启动服务

1. 创建shell script脚本
2. 配置`Script path:`路径，项目根目录`script/run/dev.sh`


#### APP_ENV不生效

1. 系统环境变量
2. docker-compose.yml配置

```shell script
$ export -p
```

#### 命令行生成系统日志权限问题

```shell script
# 使用www-data用户执行命令
$ su www-data -s /bin/bash -c "php bin/hyperf.php tools:test"
```
