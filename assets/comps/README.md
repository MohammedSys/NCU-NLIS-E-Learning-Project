### Required Libraries

This project required the following libraries to be installed:

1. phpmailer/phpmailer
2. atoum/atoum
3. smalot/pdfparser
4. Mozilla's PDF.js Project

### The Composer Package Manager

To install the listed libraries (1 - 3), please use the Composer package manager for PHP.
Ref. [Composer - Getting Started](https://getcomposer.org/doc/00-intro.md)

1. Download the installer:

`wget https://getcomposer.org/download/`

or

`curl -o installer https://getcomposer.org/download/`

2. Install the composer locally

`php installer`

3. (Optional) Make the composer available globally

`mv composer.phar /usr/local/bin/composer`

(Maybe require Root permission to perform this action.)

#### Install Libraries:

```
$ cd <Project-Path>/assets/comps/

$ composer require phpmailer/phpmailer
$ composer require atoum/atoum
$ composer require smalot/pdfparser
```

### Install PDF.js

Ref. [Setup PDF.js in a website](https://github.com/mozilla/pdf.js/wiki/Setup-pdf.js-in-a-website)

1. Download the source

`wget https://github.com/mozilla/pdf.js/archive/gh-pages.zip`

2. Unzip the compressed file and perform the followings:

```
$ cd pdf.js-gh-pages
$ mv build <Project-Path>/assets/
$ mv web <Project-Path>/assets/
```

3. Example usage

`<a href="/web/viewer.html?file=yourpdf.pdf">Open yourpdf.pdf with PDF.js</a>`





