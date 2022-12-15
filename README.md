## PSR-логгер для журнала событий Битрикс

### Установка

- Вариант 1. Склонируйте данный репозиторий в папку `/local/modules` с помощью
  команды `git clone https://github. com/stayfuneral/ramapriya.psr.logger.git`
- Вариант 2. Скачайте модуль через composer `composer require ramapriya/bitrix-psr-logger`

ВАЖНО! В вашем composer.json вам необходимо добавить следующую секцию:

```json
{
  "name": "project/name",
  "description": "your project description",
  "extra": {
    "installer-paths": {
      "path/to/modules/{$name}": [
        "type:bitrix-module",
        "type:bitrix-d7-module"
      ]
    }
  },
  "config": {
    "allow-plugins": {
      "composer/installers": true
    }
  }
}
```

После скачивания модуля зайдите в админку в раздел `Marketplace/Установленные решения` и установите модуль

### Использование

```php

use Ramapriya\Psr\Logger\EventLogLogger;

$context = [
    'key' => 'value'
];

$logger = new EventLogLogger();
$logger->error('error message', $context);

```
