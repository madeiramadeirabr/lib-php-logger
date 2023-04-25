# lib_php-mmrfc-logger

### Descrição
Biblioteca em PHP que implementa a [MMRFC](https://madeiramadeira.atlassian.net/wiki/spaces/S/pages/2317942893/MMRFC+1+-+Log) de Logs

### Contexto de negócio
- biblioteca em php

### Squad responsável
Squad SRE

### Desenvolvimento
Para ambiente de desenvolvimento

```bash
$ composer install
$ docker-compose up
```

### Testes
Para rodar os testes, raíz do projeto você deve rodar:

```bash
$ docker-compose up
$ docker exec -it mmrfc-php-logger ./vendor/bin/phpunit
```

### Instruções para uso

***Instalação***:

Rode
```bash
$ composer config repositories.lib_php-mmrfc-logger git git@github.com:madeiramadeirabr/lib_php-mmrfc-logger.git
$ composer require madeiramadeirabr/lib_php-mmrfc-logger
```


Para uso da biblioteca em projetos PHP

```php
<?php
...
use MadeiraMadeira\Logger\LoggerFactory;
...

$logger = (new LoggerFactory())->createLoggerInstance();
...

$logger->info(
    "Mensagem descritiva", ["foo" => "bar"]
);
$logger->warning(
    "Mensagem descritiva", ["foo" => "bar"]
);
$logger->error(
    "Mensagem descritiva", ["foo" => "bar"]
);
$logger->debug(
    "Mensagem descritiva", ["foo" => "bar"]
);
$logger->emergency(
    "Mensagem descritiva", ["foo" => "bar"]
);
```

***Configurando Log Level***:

```php
...
use MadeiraMadeira\Logger\LoggerFactory;
use MadeiraMadeira\Logger\Core\Config;
...

$logger = (new LoggerFactory())->createLoggerInstance(
    new Config(
        'level' => 'WARNING'
    )
);
...
```

***Log level disponíveis*** (case insensitive):
- emergency
- error
- warning
- info
- debug




Exemplo de chamada + resposta

PHP
```php
$logger->emergency(
    "Mensagem descritiva", 
    ["foo" => "bar"]
);
$logger->info(
    "Mensagem descritiva",
    [
        "global_event_name" => "ORDER CREATED",
        "user" => [
            "id" => 1,
            "order_id" => 1
        ],
        "session_id" => "abcde",
        "trace_id" => "fghi"
    ]
);
```
Resposta
```json
{
    "message":"Mensagem descritiva",
    "level":"EMERGENCY",
    "global_event_timestamp":"2023-04-25T15:19:19+00:00",
    "service_name":"A dummy Project",
    "context": {
        "foo": "bar"
    }
}

{
    "message":"Mensagem descritiva",
    "level":"INFO",
    "global_event_name": "ORDER CREATED",
    "global_event_timestamp":"2023-04-25T15:19:19+00:00",
    "service_name":"A dummy Project",
    "context": {
        "user": {
            "id": 1,
            "order_id": 1
        }
    },
    "session_id": "abcde",
    "trace_id": "fghi"
}
```

### Versões suportadas

todo
