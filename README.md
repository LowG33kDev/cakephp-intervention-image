# CakePHP Intervention Image plugin

This plugin is a [Intervention Image](http://image.intervention.io) library wrapper for [CakePHP](http://cakephp.org).

## Requirements

The master branch has the following requirements:

* CakePHP 3.1.0 or greater.
* PHP 5.4.16 or greater.
* Intervention Image 2.3 or greater

## Installation

You can install this plugin into your CakePHP application using [composer](http://getcomposer.org).

The recommended way to install composer packages is:

```
composer require lowg33kdev/cakephp-intervention-image
```

Load your plugin using
```
bin/cake plugin load CakeInterventionImage
```
or by manually putting `CakePlugin::load('InterventionImage')` in your `boostrap.php` or in your `boostrap_cli.php`.
