![Magento](https://img.shields.io/badge/Magento-2.2%20%7C%202.3%20%7C%202.4-orange?logo=data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0idXRmLTgiPz48IS0tIFVwbG9hZGVkIHRvOiBTVkcgUmVwbywgd3d3LnN2Z3JlcG8uY29tLCBHZW5lcmF0b3I6IFNWRyBSZXBvIE1peGVyIFRvb2xzIC0tPgo8c3ZnIHdpZHRoPSI4MDBweCIgaGVpZ2h0PSI4MDBweCIgdmlld0JveD0iLTIzLjUgMCAzMDMgMzAzIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHByZXNlcnZlQXNwZWN0UmF0aW89InhNaWRZTWlkIj48cGF0aCBkPSJNMTQ0Ljg1MiA5MC42N3YxNzIuMTkybC0xNi45MzMgMTAuMzQ5LTE2Ljk0Ni0xMC40MDRWOTAuODAzbC00My44NzggMjcuMDE2djE0Ny4yNTVsNjAuODI0IDM3LjIxNyA2MS4zMzktMzcuNDgyVjExNy43MjVMMTQ0Ljg1MiA5MC42N3pNMTI3LjkxOSAwTDAgNzcuNTAydjE0Ny4yNzRsMzMuMjIzIDE5LjU3MlY5Ny4wNmw5NC43MjItNTcuNTk2IDk0LjgxIDU3LjUxMi4zOTEuMjIzLS4wNDIgMTQ2LjkyOUwyNTYgMjI0Ljc3NlY3Ny41MDJMMTI3LjkxOSAweiIgZmlsbD0iI0ZGRkZGRiIvPjwvc3ZnPg==)
![PHP](https://img.shields.io/badge/PHP-7.*%20|%208.*-7377ad?logo=php&logoColor=white&labelColor=444)

# WebThings_TranslationHelper Magento 2 module

This module will allow you to grab translation files with the ability to exclude already translated ones.

## About
This module is a fork of [underser/module-translation-helper](https://github.com/underser/module-translation-helper), originally developed by Roman Sliusar. It has been enhanced to support PHP 8.2 and Magento versions 2.2.x through 2.4.x.

### Requirements

**Magento 2 platform:**

Tested on Magento v2.4.7 and v2.2.10 (will require at least v2.2 from you)

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
