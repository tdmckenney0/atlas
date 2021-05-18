# Atlas: Collaboration System

The Atlas system is designed to facilitate ease of asynchronous collaboration on project design by organizing large documents into small leafs of information with attachments. Discussion can then take place with much finer detail than ever before. It is meant to be light-weight and easy to read for all platforms. It also acts as a frontend for Pandoc, allowing documents to be created and exported on the fly. 

![Welcome Node](screenshots/node1.png "Welcome Node")

## Features

## Local Environment Setup

1. `. shell-env.sh`
2. `at-npm install`
3. `docker-compose up -d --build`
4. `at-composer install`
5. `at-cake migrations migrate` and `at-cake migrations seed`
6. Navigate to `http://localhost:4000`
7. Login with `root@example.com` using password `root`

## Dependencies
### CakePHP 3.x

[PHP MVC Framework](https://cakephp.org/)

The framework source can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).

### Bulma

Modern CSS framework.

[https://bulma.io/](https://bulma.io/)

### Pandoc

Universal document converter. 

[https://pandoc.org/](https://pandoc.org/)

### EasyMDE

Simple HTML Markdown editor. 

[https://github.com/Ionaru/easy-markdown-editor](https://github.com/Ionaru/easy-markdown-editor)
