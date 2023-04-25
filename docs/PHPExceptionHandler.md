# PHPExceptionHandler

**1. Генерация ошибки**
```php
ExceptionHandler::generateError("ошибка");
```

**Описание:** Очень часто, необходимо во время работы сгенерировать ошибку и остановить работу сайта, для этого и нужна данная функция

**Первый аргумент** - сообщение об ошибке

**ВНИМАНИЕ:** При использовании данной функции сайт останавливает работу

<br>

**2. Использование своей страницы для вывода ошибок**d
```php
ExceptionHandler::setCustomErrorPage($html);
```

**Описание:** В данном примере мы устанавливаем свою страницу для вывода ошибок

**Первый аргумент** - html верстка страницы

**ВНИМАНИЕ:** В верстке страницы в теге <body> обязательно должна быть строчка [error], для вывода вместо этой строчки сообщения об ошибке