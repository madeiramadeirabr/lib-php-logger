# lib-php-logger

## Descrição
Biblioteca em PHP que implementa a [MMRFC](https://madeiramadeira.atlassian.net/wiki/spaces/S/pages/2317942893/MMRFC+1+-+Log) de Logs

## Contexto de negócio
- biblioteca em php

## Squad responsável
Mantida pelo de SRE
Aberto para qualquer equipe atualizar e implementar funcionalidades

## Desenvolvimento
Para ambiente de desenvolvimento

```bash
$ docker-compose up --build
$ docker exec -it lib-php-logger composer install
```

## Testes
Para rodar os testes, raíz do projeto você deve rodar:

```bash
$ docker-compose up --build
$ docker exec -it lib-php-logger ./vendor/bin/phpunit
```

### Coverage 
Para gerar o coverage dos testes, raíz do projeto você deve rodar:

```bash
$ docker-compose up --build
$ docker exec -it lib-php-logger ./vendor/bin/phpunit --coverage-html ./reports
```

## Instruções para uso da biblioteca

[Acessar documentação](./docs/README.md)
 
