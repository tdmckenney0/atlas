#!/usr/bin/env bash

# get this script's directory path
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

at-cake() {
    pushd $DIR;
    docker-compose run --rm atlas bin/cake $*;
    popd;
}

at-composer() {
    pushd $DIR;
    docker-compose run --rm atlas composer $*;
    popd;
}

at-mysql() {
    pushd $DIR;
    docker exec -it atlas_mysql_1 mysql $*;
    popd;
}

alias at-serveo='ssh -R 80:localhost:4000 serveo.net'
