#!/bin/bash

set -eu

rm -f src/public/.htaccess
rm -f src/config/config.ini

echo '[general]' > src/config/config.ini
chmod 777 src/config/config.ini
chmod 777 src/config
chmod 777 src/public
