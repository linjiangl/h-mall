### 生成模型

```shell script
# 生成模型
$ php bin/hyperf.php gen:model user \
--path=app/Model/User \
--inheritance=Model \
--uses=App\\Model\\Model \
--with-comments \
--force-casts \
--refresh-fillable 
```
