#!/usr/bin/sh

# get this script's directory path
DIR=`dirname ${BASH_SOURCE[0]-$0}`;
DIR=`cd $DIR && pwd`;

# Run Composer
alias at-composer='docker exec -it atlas-atlas-1 composer --working-dir=/var/www/html';

# Run CakePHP
alias at-cake='docker exec -it atlas-atlas-1 bin/cake';

# Run NPM
alias at-npm='docker run -it -w /src --rm -v '$DIR':/src node npm';

# Run Console
alias at-bash='docker exec -it atlas-atlas-1 bash'
