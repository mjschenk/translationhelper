[![Build Status](https://travis-ci.org/webthings/module-translation-helper.svg?branch=master)](https://travis-ci.org/webthings/module-translation-helper)
![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg?style=square)

# WebThings_TranslationHelper Magento 2 module

This module will allow you to grab translation files with the ability to exclude already translated ones.

## About
This module is a fork of [underser/module-translation-helper](https://github.com/underser/module-translation-helper), originally developed by Roman Sliusar. It has been enhanced to support PHP 8.2 and Magento versions 2.2.x through 2.4.x.

### Requirements

**Magento 2 platform:**

Tested on Magento v2.3.3 and v2.2.10 (will require at least v2.2 from you)

### How to install

Run
```
composer require webthings/translationhelper

./bin/magento setup:upgrade
```

### How to use

This module will provide you *i18n:translation-helper* command, run
```
./bin/magento i18n:translation-helper --help
```
to see possible params and their meaning

### Examples of usage

```
./bin/magento i18n:translation-helper --locale fr_FR  --output ./var/fr_FR.csv --all
```
will scan whole magento directory, and create fr_FR.csv file inside *var* folder. This file will contain all phrases that not translated for fr_FR locale

```
./bin/magento i18n:translation-helper --locale fr_FR  --output ./var/fr_FR.csv ./app/code/Vendor/Module
```
will scan only *app/code/Vendor/Module*, and create fr_FR.csv file inside *var* folder. This file will contain all phrases that not translated for fr_FR locale

### Common errors

#### Missed phrase
Most often, the "Missed phrase" error is caused by the third-party extensions when the system tries to translate an empty string like __(''). Correspondingly to learn what module is causing the issues you have to run the following command: 
```
grep -rnw . -e "__('')" -e '__("")'
```
Once you track down those files you have to change __('')   to  ''  and  __("")  to  "" in the file's code.

After you made the required changes in the corresponding files, you can to regenerate the translation dictionary. The error should be eliminated. 
