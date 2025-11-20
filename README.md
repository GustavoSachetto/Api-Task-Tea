![logo](https://github.com/user-attachments/assets/91d41661-33bb-4771-b4a0-dcb25bbd368a)

# API Task TEA
Este projeto consiste numa __API-RESTFULL__ criada com o __framework Laravel__ para gerenciamento do banco de dados do aplicativo Task TEA, que é um aplicativo gerado com intuito de ajudar crianças que possuem o Transtorno do Espectro Autista (TEA).

#laravel #php8 #poo

- __Link para acesso:__ https://taskteaapi.com/api/v1

## Associação
Esse projeto é uma api seguida de um __aplicativo Android__ designado para gerenciar o __front-end__ da aplicação.
- __Respositório do APP:__ https://github.com/GustavoSachetto/App-TaskTea

## Integrantes
Desenvolvido para a entrega do Trabalho de Conclusão de Curso para o curso técnico informática para internet da escola Etec Dr. Emílio Hernandez do ano de 2024.

__Os colaboradores desse projeto foram:__ 

<a href="https://github.com/GustavoSachetto" target="_blank">Gustavo Sachetto</a>, 
<a href="https://github.com/iCrowleySHR" target="_blank">Gustavo Gualda</a>, 
<a href="https://github.com/dartres" target="_blank">Brenda Caroline</a>,
<a href="https://github.com/matheussantosrodrigues" target="_blank">Matheus Santos</a>,
<a href="https://github.com/Miguelzzzz" target="_blank">Miguel Marcondes</a> e 
<a href="https://github.com/phpparker" target="_blank">Pedro Henrique</a>.

## Desenvolvendo
Para criar esta __API-RESTFULL__ projeto, foi necessário o estudo das seguintes ferramentas e tecnologias:

- PHP 8.2
- Composer 2.7.9
- Laravel Framework 11.9
- Arquitetura REST
- Insomnia (Teste das rotas)
- Código de status HTTP
- Sistema de Cache por arquivo
- Processamento do envio de Emails
- Collection, Request e Resource
- Seeders, Factories e Migrations
- Queue (Filas gerenciadas pelo banco de dados)
- Eloquent ORM
- Upload de imagens
- Conversão de imagens de png/jpeg para Base64
- Laravel Spatie (Tratamento de permissões e papeis dos usuários)

## Requisitos

* PHP 8.2 ou superior
* Composer 2.7.9 ou superior

## Documentação
Toda a documentação das rotas da api estão contidas abaixo no arquivo __.json__, esse arquivo pode ser aberto com programas como __Postman__ ou __Insomnia__ (recomendado).

- __Arquivo json:__ [click para download](https://github.com/user-attachments/files/17969354/Documentacao.da.API-TaskTea.json)

## Comandos iniciais
Principais comandos para iniciar o projeto:

- Clonar repositório do projeto

```
git clone https://github.com/dartres/API-TaskTea.git
```

- Mudar para pasta do projeto
  
```
cd API-TaskTea
```

-  Instalar as dependências do projeto 

```
composer install
```

- Copiando arquivo de configuração .env 

```
cp .env.example .env
```

- Gerar chave de criptografia do laravel

```
php artisan key:generate
```

-  Executar as tabelas do banco de dados

```
php artisan migrate
```

-  Inserir informações no banco de dados

```
php artisan db:seed
```

- Permitir a criação de link simbólico de imagens

```
php artisan storage:link
```

-  Executar o servidor do laravel

```
php artisan serve
```

Para acessar a API, é recomendado utilizar o Insomnia ou PostMAN para simular requisições à API.
```
http://127.0.0.1:8000/api/v1
```

## Projeto
Toda a documentação da criação do projeto desde o planejamento até a conclusão do projeto final funcionando.

- __Arquivo do TCC pdf:__ [click para download](https://github.com/user-attachments/files/17969719/Documentacao.TCC.TaskTea.pdf)

***********
