Skeleton API
=============
[![Build Status](https://travis-ci.org/romeumattos/twitter-like.svg?branch=master)](https://travis-ci.org/romeumattos/twitter-like)
[![Codacy Badge](https://api.codacy.com/project/badge/Grade/d13b304b7c514ca5a3339b4cb9138367)](https://www.codacy.com/app/romeu-smattos/twitter-like?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=romeumattos/twitter-like&amp;utm_campaign=Badge_Grade)
[![Code Climate](https://codeclimate.com/github/romeumattos/twitter-like/badges/gpa.svg)](https://codeclimate.com/github/romeumattos/twitter-like)

Twitter Like API REST

Este é um projeto de cadastro de mensagens baseado no [Silex Api Skel](https://github.com/mrprompt/silex-api-skel)

Ele utiliza sub componentes como:

- [Silex DI Builder](https://github.com/mrprompt/silex-di-builder)
- [Silex CORS Provider](https://github.com/mrprompt/silex-cors-provider)
- [Silex Router Provider](https://github.com/mrprompt/silex-router-provider)

Instalação
==========
É necessário o PHP 7.0.x

## Extensões necessárias
- curl
- pdo
- reflection
- json
- xdebug (opcional)

## Instalação
Baixe o [Composer](https://getcomposer.org/)

```
composer.phar install --prefer-dist -o
```

## Rodando as Fixures
```
./vendor/bin/phing fixtures
```


## Rodando localmente
Você pode utilizar o [servidor web embutido](http://php.net/manual/pt_BR/features.commandline.webserver.php) no [PHP](http://www.php.net)
para rodar localmente a API. Ou se preferir, configurar seu servidor web preferido apontando para a pasta *public*.
```
php -S localhost:8080 -t public
```

## Rodando em modo desenvolvimento
Rodar a API em modo de desenvolvimento, você deve definir a variável de ambiente *APPLICATION_ENV* com o valor *development*.
Caso a variável não esteja definida, o valor padrão é *production*.
Em modo de desenvolvimento, a aplicação irá mostrar todas as mensagens de erro e também de irá logar as mensagens de 
debug.
```
APPLICATION_ENV="development" php -S localhost:8080 -t public
```

## Testando
```
./vendor/bin/phpunit
```

## Rotas
- User
  - Url: /message/1
  - Método: GET

- User
  - Url: /message/
  - Método: GET

- User
  - Url: /message/
  - Método: POST
  - Parameters:
    - title
    - text

## Como contribuir

- faça um fork e envie um pull request
- clique em 'star' :)
