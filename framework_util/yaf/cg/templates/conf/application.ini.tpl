[common]
application.directory = APPLICATION_PATH  "/application"
application.dispatcher.catchException = TRUE
;composer
composer.toggle = TRUE
composer.directory = APPLICATION_PATH "/vendor"
;布局
layout.directory = APPLICATION_PATH "/application/views/layout"
layout.file = "default.phtml"
;资源
assets.directory = '/assets'
;日志
monolog.filename = '/tmp/time.log'
monolog.maxfiles = 1
monolog.level = 'debug'

[product : common]
;db
db.autoload = FALSE
db.database_type = mysql
db.database_name = time
db.server = 127.0.0.1
db.username = root
db.password = 123123
db.charset = utf8
;redis
redis.autoload = TRUE
redis.host = 127.0.0.1