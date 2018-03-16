# Material Manager

## Introduction

to set up project You need vagrant probably in version higher than 1.8.5.

if you already have it installed, just:
```
vagrant up
```

it will take a while, but later on You has only to do following commands in project directory :) 
```
vagrant ssh -c 'composer install'
vagrant ssh -c './vendor/bin/doctrine-module orm:schema-tool:update -f'
```

it should be now available on 192.168.33.80, but i recommend to add this one to hosts as materialmanager.test 