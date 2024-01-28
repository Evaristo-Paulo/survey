# About IASK

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

<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/login_main.png"></a>


## Principais funcionalidades

- Autenticação alternativa: Usando sua conta Gmail;
- Jobs: Para envio de enquete por e-mail;
- Cron Job: Para agendamento de tarefas (mudar o estado das enquetes após atinguirem o prazo de validade);
- Broadcast e Events: Actualização em tempo real no frontend;
- Pusher: API para notificação em tempo real;
- E muito mais.

Dashboard
<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/dash.png"></a>

Site/Página para a votação
<a href="http://127.0.0.1:8000/sys/login" target="_blank"><img src="https://github.com/Evaristo-Paulo/survey/blob/main/public/admin/assets/images/img_doc/votacao.png"></a>

## Tecnologias utilizadas

Este projecto foi desenvolvido utilizando o framework Laravel Versão 9

- PHP/Laravel
- HTML
- JQuery
- MySql


## Nota importante

Entre em contacto comigo a partir do meu [linkedin](https://www.linkedin.com/in/evaristo-paulo), de forma a contribuir neste ou futuros projectos.

Deixe uma estrela para dar aquela motivação extra :D

