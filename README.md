<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About IASK

 IASK is a survey management system that aims to extract specific data from a particular group of people in the form of direct questions and answers. 

 O sistema foi desenvolvido usando alguns conceitos avançado do Laravel, nomedamente: Cron Shedules, Broadcasting event, Notification, etc.

## Sistema de gerenciamento de enquetes

[iAsk](https://iask-enquete.herokuapp.com) é uma plataforma online para gerenciamento de enquetes, que visa extrair dados específicos de um determinado grupo de pessoas, em forma de perguntas e respostas diretas.


## Como rodar o projecto

Após configurar o projecto localmente na sua máquina, execute os seguintes comandos:

Passo 1: php artisan migrate:fresh --seed (Para criar as tabelas da base de dados e gerar o usuário de teste)

Passo 2: php artisan serve (Para subir o projecto)


## Acesso rápido e credenciais

Clica [aqui](http://127.0.0.1:8000/sys/login) para aceder a roda de login.

E-mail teste: admin@gmail.com

Senha: admin


## Principais funcionalidades

- Jobs: Para envio de enquete por e-mail.
- Cron Job: Para agendamento de tarefas (mudar o estado das enquetes após atinguirem o prazo de validade)
- Broadcast e Events: Actualização em tempo real no frontend.
- Pusher: API para notificação em tempo real  
- Etç
  

## Tecnologias utilizadas

Este projecto foi desenvolvido utilizando o framework Laravel Versão 9

- PHP/Laravel
- HTML
- JQuery
- MySql


## Nota importante

Entre em contacto comigo a partir do meu [linkdin](https://www.linkedin.com/in/evaristo-paulo), de forma a contribuir neste ou futuros projectos.

Deixe uma estrela para dar aquela motivação extra :D

