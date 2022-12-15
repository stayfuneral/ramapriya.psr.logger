## PSR-логгер для журнала событий Битрикс

### Установка

- Склонируйте данный репозиторий в папку `/local/modules` с помощью
  команды `git clone https://github. com/stayfuneral/ramapriya.psr.logger.git`
- После скачивания модуля зайдите в админку в раздел `Marketplace/Установленные решения` и установите модуль

### Использование

```php

use Ramapriya\Psr\Logger\EventLogLogger;

$context = [
    'key' => 'value'
];

$logger = new EventLogLogger();
$logger->error('error message', $context);

```
