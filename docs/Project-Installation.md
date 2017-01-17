##Project install

### 1) Get the stub
- git clone the project to your environment 

### 2) Run the install script
  you will need to have access to a shell in your environment that supports curl and php at the command line to use the install script

`[projectname]/install.sh`
```
curl -sS https://getcomposer.org/installer | php
php composer.phar self-update
php composer.phar install
php composer.phar update
php composer.phar dump-autoload --optimize 
```
### 3) Configure just-core 
  edit the configuration files in `[projectname]/CONFIG/AUTOLOAD`

you'll need to set DB, credentials, Data Source Name and other application settings
   
[Application Configuration](https://github.com/CHGLongStone/just-core-stub/wiki#application-configuration)

###4) Configure (Virtual) Host directives
  * determine the  [base install you would like](https://github.com/CHGLongStone/just-core-stub/tree/master/APIS)
 

#### typical api focused install
   * copy the [stub_AJAX](https://github.com/CHGLongStone/just-core-stub/tree/master/APIS/stub_AJAX) directory into your own directory 
   * configure your web application server to allow access to this directory
    - set the virtual host configuration
```
<Directory [base_path]/[install_instance]/APIS/[myDirectory]>
	DirectoryIndex index.php
	AllowOverride All
	Order allow,deny
	Allow from all
	SetEnv APPLICATION_ENV "DEV"
</Directory>
```
#### typical website focused install
- create a directory called httpd in your base install 
- copy the contents of [default_http](https://github.com/CHGLongStone/just-core-stub/tree/master/APIS/default_http) into your new httpd directory
- create a directory called /api/ in your httpd directory 
- copy the contents of [stub_AJAX](https://github.com/CHGLongStone/just-core-stub/tree/master/APIS/stub_AJAX) into your new httpd/api/ directory
    - set the virtual host configuration
```
<Directory [base_path]/[install_instance]/httpd>
	DirectoryIndex index.php
	AllowOverride All
	Order allow,deny
	Allow from all
	SetEnv APPLICATION_ENV "DEV"
</Directory>
```

