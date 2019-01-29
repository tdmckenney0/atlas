#!/usr/bin/env bash

# get this script's directory path
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

at-cake() {
    pushd $DIR;
    docker-compose run --rm atlas bin/cake $*;
    popd;
}

at-mysql() {
    pushd $DIR;
    docker exec -it storymaker_mysql_1 mysql $*;
    popd;
}
