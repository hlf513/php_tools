#生成Model类

根据数据库+表名自动生成常用的Model类

##Usage

1. 把`Common.php`放入到`kohana/application/classes/Model`下
1. 把`generator.php`放入任何位置,修改其中的路径地址
1. 运行命令:  
```
/usr/bin/php generator.php database table generator_path
```

> `generator_path` 路径后必须加`/`