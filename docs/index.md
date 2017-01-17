#Project Summary

This project is an example of how to use the [just-core framework](https://github.com/CHGLongStone/just-core) 

##Project setup

    - Private repository: 
           - git clone this project
           - delete the .git directory
           - add it to your own repository
    - Public repository: feel free to fork this

###Project install

see: [Project-installation](https://github.com/CHGLongStone/just-core-stub/wiki/Project-installation)

###The Layout

the expected install is expected to use composer https://getcomposer.org/


```
[project name]/
	composer.json
	composer.phar
	init.php
	/
```

Services are called by name-space via the transport layer in their native transport envelope, the service manager then calls the service in the format `[serviceName][methodName]` with the arguments being supplied as the transport envelope dictates. When the response to the service call has been processed the service will respond in the format dictated for the API (AjAX->AJAX, ReST->JSON, ReST->URI_ENCODED, ReST->SOAP)

* Services must conform to one of the name spaces specified in [supported composer autoload formats](https://getcomposer.org/doc/04-schema.md#autoload).
* Services can be called singly, chained or on demand within the application architecture.

Services can be configured with their own auto loaded values if they follow the format shown [here](https://github.com/CHGLongStone/just-core-stub/wiki#application-configuration)
