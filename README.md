# Atlas: Collaboration System

The Atlas system is designed by Xenolith Games, LLC in California to facilitate ease of asynchronous collaboration on project design by organizing large documents into small leafs of information with attachments. Discussion can then take place with much finer detail than ever before. It is meant to be light-weight and easy to read for all platforms. This is a pure server application! The front end is to be kept as clean as possible. 

## Local Environment Setup

1. `git clone USER@daedalus.xenolithgames.com:/media/sync/repos/atlas.git` 
2. `docker-compose up -d --build`
3. `. shell-env.sh`
4. Update the MySQL Database
    1. `docker exec -it atlas_mysql_1 mysql -u root -p atlas < backup.sql`, or...
    2. `at-cake migrations migrate` and `at-cake migrations seed`
5. Navigate to `http://localhost:4000`

### Passwords

* Database
    * Username: root
    * Password: root

## CakePHP 3.x

The framework source code can be found here: [cakephp/cakephp](https://github.com/cakephp/cakephp).