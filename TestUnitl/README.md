# `TestUnitl`
> 这是针对`mynote`接口进行的单元测试项目，功能是报警错误接口发送邮件给相关人员。

## 安装`PHPUnit`测试框架
```shell
$ wget http://phar.phpunit.cn/phpunit.phar
$ chmod +x phpunit.phar
$ sudo mv phpunit.phar /usr/local/bin/phpunit
$ phpunit --version
PHPUnit 6.2.4 by Sebastian Bergmann and contributors.
```

## 命令行`cli`模式运行本项目可直接查看日志：
```shell
$ phpunit test.php
```
示例如下：
```shell
PHPUnit 6.2.4 by Sebastian Bergmann and contributors.

..                                                                  2 / 2 (100%)

Time: 301 ms, Memory: 8.00MB

OK (2 tests, 2 assertions)
```

## 网页模式运行可发送邮件报警

### 可使用`workerman`定时任务访问触发网页模式
> 建议每`500s`执行，邮件会频繁发送

## 官方链接以及手册
- [官网链接 - http://phpunit.cn/getting-started.html](http://phpunit.cn/getting-started.html)
- [使用手册 - http://phpunit.cn/manual/6.5/zh_cn/index.html](http://phpunit.cn/manual/6.5/zh_cn/index.html)