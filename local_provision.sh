#!/bin/bash

set -eu


apt-get update -y

DEBIAN_FRONTEND=noninteractive apt-get install -y ansible

ansible-playbook -i provision/inventories/develop/hosts provision/site.yml --check
