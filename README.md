# Atlas: Collaboration System

The Atlas system is designed to facilitate ease of asynchronous collaboration on project design by organizing large documents into small leafs of information with attachments. Discussion can then take place with much finer detail than ever before. It is meant to be light-weight and easy to read for all platforms. This is a pure server application! The front end is to be kept as clean as possible. 

## Local Environment Setup

1. `docker-compose up -d --build`
2. `. shell-env.sh`
3. `at-composer install`
4. `at-cake migrations migrate` and `at-cake migrations seed`
5. `at-npm install`
6. Navigate to `http://localhost:4000`

### Passwords

* Database
    * Username: root@example.com
    * Password: root

## CakePHP 3.x

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).