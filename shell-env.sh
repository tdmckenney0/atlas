#!/usr/bin/env bash

# get this script's directory path
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

sm-cake() {
    pushd $DIR;
    docker-compose run storymaker bin/cake $*;
    popd;
}
