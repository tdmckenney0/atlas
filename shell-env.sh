#!/usr/bin/sh

# get this script's directory path
DIR=`dirname ${BASH_SOURCE[0]-$0}`;
DIR=`cd $DIR && pwd`;

# Run Composer
alias at-composer='docker exec -it atlas_atlas_1 composer --working-dir=/var/www/html';

# Run CakePHP
alias at-cake='docker exec -it atlas_atlas_1 bin/cake';

# Run MySQL
alias at-mysql='docker exec -it atlas_mysql_1 mysql';

# Run NPM
alias at-npm='docker run -it -w /src --rm -v '$DIR':/src node npm';
