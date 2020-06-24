# amocrm-test-task
Простая интеграция с AmoCRM при помощи cURL для тестового задания

## Установка

Для того чтобы установить интеграцию нужно

```
$ cd /install/path/
$ git clone https://github.com/skidanovilya/amocrm-test-task.git
$ php composer.phar update
```

После необходимо сконфигурировать интеграцию в файле ```app/Config/Config.php```

```
public function __construct() {
  $this->URL_ROOT                 = "http://localhost";
  $this->APP_ROOT                 = dirname(__DIR__);
  $this->CLIENT_ID                = "CLIENT_ID";
  $this->CLIENT_SECRET            = "CLIENT_SECRET";
  $this->CLIENT_REDIRECT_URI      = "CLIENT_REDIRECT_URI";
  $this->CLIENT_SUBDOMAIN         = "CLIENT_SUBDOMAIN";
}
```

В конце запустить при помощи php built-in server
```
$ sudo php -S localhost:80 public/ -c php.ini
```

Готово!
