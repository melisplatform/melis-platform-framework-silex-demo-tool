# melis-platform-framwork-silex-demo-tool

This demo tool has for goal to show how you can use the framework Silex inside Melis Platform, so you're not locked on ZF.

### Prerequisites

This module requires melisplatform/melis-platform-frameworks in order to have this module running. This will automatically be done when using composer.
 
### Installing

```
composer require melisplatform/melis-platform-framework-silex-demo-tool
```
 

### Configuration

A configuration inside ```/config/module.config.php``` is required for this tool to work properly. <br/>
This tool needs the index.php path of the Silex. <br/>

```
return [
  'third-party-framework' => [
     'index-path' => [
        '/Silex/web/index.php'
     ]
   ],
   ...
]
```
