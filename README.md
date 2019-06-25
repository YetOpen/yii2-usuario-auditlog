# Audit logging for Yii2-Usuario

Once installed the extension will load automatically and log security related events of users, like
login, logout, password reset. 

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist yetopen/yii2-usuario-auditlog "*"
```

or add

```
"yetopen/yii2-usuario-auditlog": "*"
```

to the require section of your `composer.json` file.


## Usage

The extension will load itself by using the bootstrap interface. It will log activities with severity
`info` and category `usuario.audit`.  You can define a custom logfile by declaring a log target in config file like this:

```php
[
    'class' => 'yii\log\FileTarget',
    'levels' => ['info'],
    'categories' => ['usuario.audit'],
    'logFile' => "@runtime/logs/audit.log",
],
```

For other logging options see [Yii's log target configuration](https://www.yiiframework.com/doc/guide/2.0/en/runtime-logging#log-targets).
