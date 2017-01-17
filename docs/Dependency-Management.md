Dependency management is handled through [Composer](https://getcomposer.org/)

####Composer Quick Links
* [Composer: Require](https://getcomposer.org/doc/01-basic-usage.md#the-require-key)
* [Composer: Packagist](https://getcomposer.org/doc/01-basic-usage.md#packagist)
* [Composer: Repositories](https://getcomposer.org/doc/05-repositories.md)
* [Composer: Autoloading](https://getcomposer.org/doc/01-basic-usage.md#autoloading)
* [Packagist](https://packagist.org/)



You can easily include other packages that are available through the [composer load mechanism](https://getcomposer.org/doc/05-repositories.md) including your own private repositories.

Composer can also add your own PSR-4 namespace compliant functions and classes into the autoload schema through the  [autoload.classmap](https://getcomposer.org/doc/01-basic-usage.md#autoloading) array. For example:

[project name]/[SERVICES] is the default directory for your own development but you can include whatever directories you like under the classmap. 
```
	"autoload" : {
		"classmap" : [
			"SERVICES"
		]
	}
```


#### PACKAGES and PLUGINS
Use composer to include 3rd party libraries. All public just-core packages are [registered](https://packagist.org/packages/just-core/) with [Packagist](https://packagist.org).

```
	"require" : {
		"php" : ">=5.3.7",
		"just-core/foundation" : "dev-master",
		"just-core/auth-page" : "dev-master",
		"just-core/auth-login" : "dev-master",
		"just-core/data-postgres" : "dev-master",
		"just-core/dao-orm" : "dev-master",
		"just-core/metronic" : "dev-master",
		"just-core/cli-harness" : "dev-master",
		"just-core-scripts" : "dev-master",
		"just-core/http-optimization" : "dev-master",
		"kriswallsmith/assetic" : "@dev",
		"mrclay/minify" : "2.3.0",
		"natxet/CssMin": "v3.0.4",
	},
```



