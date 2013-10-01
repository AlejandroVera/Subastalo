#! /bin/bash
mkdir smarty-data
mkdir smarty-data/templates
mkdir smarty-data/templates_c
mkdir smarty-data/cache
mkdir smarty-data/configs
chown nobody:nobody smarty-data/templates_c
chown nobody:nobody smarty-data/cache
chmod 775 smarty-data/templates_c
chmod 775 smarty-data/cache
