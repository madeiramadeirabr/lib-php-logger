# Por instância

Nessa documentação temos:
- [Quando utilizar](#quando-utilizar)
- [Como usar](#uso-base)
- [Como alterar as configurações](#alterando-as-configurações-default)
- [Exemplos de uso](#exemplo-de-entrada-e-saída)

### Quando utilizar

Esse formato deve ser utilizado quando for possível utilizar injeção de dependência em seu projeto.

### Uso base

```php
<?php

use MadeiraMadeira\Logger\LoggerFactory;

$logger = (new LoggerFactory())->createLoggerInstance();
...
$logger->trace(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
$logger->debug(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
$logger->info(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
$logger->warning(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
$logger->error(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
$logger->emergency(
    "Mensagem descritiva", ["foo" => "bar"], "GLOBAL_EVENT_NAME"
);
```

### Alterando as configurações default

Para a configuração inicial, a biblioteca está configurado para:
- Enviar as mensagens para a saída padrão (stdout)
- Level info 
- Service name buscando da váriavel de ambiente APP_NAME, caso não seja passado na configuração o "serviceName" e não esteja configurado o APP_NAME, a biblioteca colocará o nome "A dummy project"

Para altera a configuração inicial, basta instanciar uma nova configuração e passar como parâmetro na função createLoggerInstance.

```php
<?php

use MadeiraMadeira\Logger\LoggerFactory;
use MadeiraMadeira\Logger\Config;

$config = new Config([
    "streamHandler" => "/tmp/log.txt",
    "level" => "DEBUG",
    "serviceName" => "my-dummy-service"
]);

$logger = (new LoggerFactory())->createLoggerInstance($config);
```

### Exemplo de entrada e saída

PHP
```php
$logger->emergency(
    "Mensagem descritiva", 
    ["foo" => "bar"]
);
$logger->info(
    "Mensagem descritiva",
    [
        "user" => [
            "id" => 1,
            "order_id" => 1
        ],
        "session_id" => "abcde",
        "trace_id" => "fghi"
    ],
    "ORDER CREATED",
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
