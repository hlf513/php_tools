# php-apidoc-extension
修改了 [php-apidoc](https://github.com/calinrada/php-apidoc) 的 `Builder.php` , 定制一些输出模板样式

##修改与扩展
###修改
1. 隐藏了info中的header
1. 隐藏了sandbox

###扩展
1. 针对 @ApiMethod,增加了 label

```
* @ApiMethod(type="post",label="上传")
```


##使用步骤
1. 安装php-apidoc
1. 替换Builder.php
1. 集成到框架中

##集成Kohana
1. 把kohana.php放入到`kohana/`目录下,并改名`apidoc.php`
1. composer.json放入到`kohana/`目录下
1. 使用命令行生成文档

``` php
// 查看命令帮助
./apidoc.php 
```
注释示例:

```
/**
 * @ApiDescription(section="上传页面", description="post:上传图片;每次只处理一张图片")
 * @ApiMethod(type="post",label="上传")
 * @ApiRoute(name="/handmark/upload/index")
 *
 * @ApiParams(name="$_FILES", type="resource", nullable=false, description="上传文件",sample="{}")
 *
 * @ApiReturnHeaders(sample="HTTP 200 OK")
 * @ApiReturn(type="array", sample="
 *     [
 *     'error'=>'',
 *     ]
 * ")
 */
```

