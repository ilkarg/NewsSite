# IcebergPHP
IcebergPHP - это современный фреймворк для веб-приложений. IcebergPHP выделяется на фоне других фреймворков своей компактностью, простотой установки, а так же тем, что сделан в России.
## Требования
- PHP >= 7
- Подключенные зависимости из [php.ini](ini/php.ini)
## Установка
1) Устанавливаем PHP
2) Загружаем или клонируем шаблон
3) Проверяем, чтобы в [bootstrap.php](database/bootstrap.php) были указаны правильные данные для подключения к Базе Данных
4) Для ОС Windows подключаем все зависимости из файла [php.ini](ini/php.ini)
5) Перезапускаем ```terminal``` или ```cmd```, если до этого был открыт
6) Открываем ```terminal``` или ```cmd``` и вводим ```php iceberg start``` или ```php iceberg start 8000```, где вместо 8000 вводим нужный порт
7) После запуска сайт будет доступен на ip адресах: 127.0.0.1:8000, 192.168...:8000 и другие

1) Скачать или склонировать репозиторий в удобное место
2) Написать код
3) ```php iceberg start``` или ```php iceberg start 8000```, где вместо 8000 вводим нужный порт
4) Наслаждаться результатом
## Документация
- [PHPExceptionHandler](docs/PHPExceptionHandler.md)
- [PHPSystem](docs/PHPSystem.md)
- [PHPTemplater](docs/PHPTemplater.md)
- [PHPView](docs/PHPView.md)
- [PHPHash](docs/PHPHash.md)
- [PHPRequester](docs/PHPRequester.md)
## Структура
```
app/                  Системные библиотеки   
controllers/          Контроллеры
database/			  Файлы для работы с Базой Данных
docs/                 Документация
ini/				  Файл php.ini
models/               Модели
pages/                Страницы
routes/               Маршруты
```
## Использование iceberg
**1. Создание контроллера**
```sh
php iceberg create-controller TestController
```

**Описание:** Создает контроллер TestController в директории controllers. Если директория controllers отсутствует, то создает ее. Самостоятельно импторирует контроллер в файл index.php

<br>

**2. Создание модели**
```sh
php iceberg create-model User
```

**Описание:** Создает модель User в директории models. Если директория models отсутствует, то создает ее

## Участие в разработке
Здесь вы можете предложить свою идею для будущего обновления - [Предложить](https://github.com/mrProger/IcebergPHP/issues/1)

# Проекты разработанные на IcebergPHP
1. [Новостной портал Senstation](https://github.com/mrProger/NewsSite) (Дипломный проект)
2. [Сайт автосалона Mercedes](https://github.com/mrProger/CarsShop) (Дипломный проект)
3. [Сайт Строительно-монтажного управления Смурфик](https://github.com/mrProger/Smurfik2.0) (Дипломный проект)
4. [Сайт котокафе](https://github.com/mrProger/CatsCafe) (Дипломный проект)
