# fitz.to/gether #

### How do I get set up? ###

This theme uses Grunt to build CSS and process JavaScript.

#### Dependencies ####
##### Ruby Gems #####
* sass >= (3.4.4)
* susy >= (2.1.3)
* breakpoint >= (2.5.0)
##### Other #####
* Node.js >= v0.10.32
* Bower
* WP-CLI >= 0.17.0
  * this is the only one that you could get by without.

#### Getting Started ####
* clone this repo
* search and replace in the theme files
  * change 'pixelspoke_boilerplate' to 'NEW_THEME_SLUG'
* rename the theme folder
* change the theme name and info in scss/style.scss
* from the theme folder run
```
bower install
```
* then
```
npm install
```
* you might have to run this as an administrator
* then also from the theme folder run
```
grunt
```
* this will compile your css and js to all the right places
* change directories to the document root and run
```
wp core download
```
* rename wp-config-sample.php
```
mv wp-config-sample.php wp-config.php
```
* configure wp-config.php
* while you are there, add this to wp-config.php
```
define('WP_DEBUG', true);
define('PIX_ENVIRONMENT', local);
```
* create the database according to what you just defined in wp-config.php
```
wp db create
```
* If this is a new site, hit the url in your browser and fill out the new site setup steps
* If this is an existing site, import the database now.
* and you are ready to roll!!

### Who do I talk to? ###
* Fitz put this together. Feel free to give me a holler if you have any questions!