# melis-platform-framwork-silex-demo-tool

This Melis module acts as the container that will display the content of the Silex based modules as a tool in the Melis Platform.

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
