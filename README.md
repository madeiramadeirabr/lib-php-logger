# lib_php-logger

### Descrição
Biblioteca em PHP que implementa a [MMRFC](https://madeiramadeira.atlassian.net/wiki/spaces/S/pages/2317942893/MMRFC+1+-+Log) de Logs

### Contexto de negócio
- biblioteca em php

### Squad responsável
Mantida pelo de SRE
Aberto para qualquer equipe atualizar e implementar funcionalidades

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

### Instruções para uso da biblioteca

[Acessar documentação](./docs/README.md)
 
  