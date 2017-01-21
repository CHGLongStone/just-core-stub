# Configuration

* [also see: Configuration Manager](../just-core/Configuration-Manager)

## Overview 

The just-core configuration manager uses a Zend style file pattern matching `*{global,local}.php` to load files from the  
`[application_root]/CONFIG/AUTOLOAD` directory. 

* Any file matching that mask will be loaded by default.
* Files Excluding "global" or "local" in the namespace _WILL NOT_ be loaded

The `$GLOBALS["CONFIG_MANAGER"]` object can be set to cache all of the files matching the `*{global,local}.php` into a single 
compiled file. The contents of this file are updated if any of the files change

The pattern is to load all _global_ files FIRST, Then load and apply _local_ file settings



> the pattern matching is also applied to .gitignore
> any file matching the `*local.php` mask will be _IGNORED_
> 
> When using the release script in the Production environment `[application_release#]/CONFIG/AUTOLOAD` is a symbolic link back to 
> `[application_prod]/cfg` 
> 
> `*global.php` files will _ALWAYS_ be over written 
> 
> `*local.php` files will _NEVER_ be over written 


## File Structure

Configuration files follow a common format:

```
<?php 
return array(
   'firstIndex' => array(
        /*optional*/
        'secondIndex' => array(
           /*optional*/
           'thirdIndex' => 'array/scalar/...etc.'
        )
    ),
);
?>
```


Configuration options are recalled through the configuration manager which is reference in the $GLOBALS scope `$GLOBALS['CONFIG_MANAGER']->getSetting($firstIndex, $secondIndex, $thirdIndex);`.

* $firstIndex is a required parameter
* $secondIndex, $thirdIndex are optional parameters

`CONFIG_MANAGER` will only look up to the 3rd index for results, if you need data that is nested deeper you will need to parse it the calling context









