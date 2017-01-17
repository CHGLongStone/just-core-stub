stub_AJAX 
## stub_AJAX example
[[project name]/APIS/stub_AJAX](https://github.com/CHGLongStone/just-core-stub/tree/master/APIS/stub_AJAX)
* DAO_example.php
* example.php
* index.php
* jquery-1.11.2.min.js
* README.md
* send.php
* test.php

###index.php
This is your API harness, the [file](https://github.com/CHGLongStone/just-core-stub/blob/master/APIS/stub_AJAX/index.php) sets a couple basic settings then calls the bootstrap file [[projectname]/inip.php ](https://github.com/CHGLongStone/just-core-stub/blob/master/init.php)

###test.php
this is a simple test of your installation, as well as a form to call ajax requests to your API this should be removed in production installs 
this variable `var API_PATH = 'http://just-core-stub.com';` must be updated

### send.php
this is a depricated form to test your API, this should be removed in production installs 

###DAO_example.php
a sparse example on how to use the DAO layer