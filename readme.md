# Composer
> Php Dependency Manager. [INSTALL](http://www.getcomposer.org)


### Initialize Composer.

```
composer init
//Tap Enter for all the given option which will finally create a composer.init
//file in your project directory.
```


### Install Package

```
    composer require package/name
    //which will go to the git hub for this package and download all the files (dependencies).
   
   composer require illumniate/support
   //has some few helper function that helps to work with arrays. 
```

Requiring a package will get installed in a vendor folder and the dependencies are managed by a
autoload.php file therefore

```
<?php
require_once 'vendor/autoload.php'
```

#### Basic Composer Commands
* Composer install (looks at composer.lock file, composer.lock file locks the php version when it was first installed)
* Composer update (looks at composer.json file and updated or install a new version)
* Composer init
* Composer dump-autoload.
* Composer require (to install a particular package/composer install looks to the composer.json file and download the dependencies listed in it)
* Composer require --dev package/name (requires only for the development version)
* Composer remove package/name
* Composer create-project package/name folder_name (to create a project based on all the packages of package/name)



### PSR4 Autoloading.

```
"autoload":{
    "psr-4":{
        
    },
    "files":[
    
    ],
    "classmaps":[
    
    ]
}
```

##### PSR4
in a project we usually have one base folder and many sub folder inside that which 
contains several Classes.  
eg:-
```
app
    Controller
        UserController.php
    Models
        User.php
```
You can use the composer    `psr4` autoloading for requiring those classes
wherever you want in your project.

```
  "autoload": {
    "psr-4": {
      "App\\": "app"
    }
  }
```

UserController.php
```

namespace App\Controller;

class UserController
{
    public function __construct()
    {
        echo "User Controller...";
    }
}
``` 
index.php
```
require_once 'vendor/autoload.php';
$userController = new \App\Controller\UserController();
//All the classes in the App Folder can be used like this.
```

Namespacing is not mandatory but if you are having multiple folder and classes with same name then having namespace 
will make sense.



##### Files
Array of files basically used if we have a file with a collection of functions.
  
composer.json settings.
```
  "autoload": {
    "psr-4": {
      "App\\": "app"
    },
    "files": [
      "helpers/data.php"
    ]
  }
```



##### Class Map
Very similar to psr4 but it does not rely on on sub folder to confirm to namespacing that psr4 confirms to.  
eg:-
```
//directory structure
app
    class
        subfolder
               MyClass.php
               MyClass2.php
                    
```

If we were following the PSR4 autoloading then we should have the
namespace for `MyClass.php` as `App\Class\Subfolder` but when using the class
map with any namespacing.

composer.json setup
```
  "autoload": {
    "psr-4": {
      "App\\": "app"
    },
    "files": [
      "helpers/data.php"
    ],
    "classmap": [
      "app/classes"
    ]
  }
```
MyClass.php
```
class MyClass {
       
}
```

MyClass2.php
```
namespace Any;
class MyClass2{

}
```

index.php
```
require 'vendor/autoload.php'
new MyClass();
new Any/MyClass2();//any namespace can be used.
```

#### Composer.lock
basically the first time you initialize the composer project 
this file does not exists. It will appear once you run the composer install
command so basically this file is to lock down your project to a set of version of each
package.  
If you give your project to someone along with the composer.lock file and that person runs the 
command `composer install` than this will go to the remote repository and grab the version that is locked
in the composer.lock file not the latest version of the library.  
If you do `composer update` it will not look into the lock file and will fetch the latest version of those package. 