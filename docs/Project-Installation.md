##Project First Time Install

### Prerequisites 

to use the install script you will need to have access to a shell in your environment that supports:
  * curl 
  * php 
  * git 

### 1) Get the stub

git clone/fork or download and extract the project to your environment 


### 2) Run the install script

```
# cd [project_path]
# ./install.sh -cI -dWRITELOCAL
```

> -cI 
>
> * install Composer then run Composer self-update, install, dump-autoload
>
> -dWRITELOCAL 
> * create or over write database configurations in ./CONFIG/AUTOLOAD/data.local.php
>   * Then install the ./data/schema/schema.sql example
> 
> see [Scripts](Scripts) for further information

  
### 3) Serve it up
  
#### ./_UI/MAIN_UI

A website based example, requires:

* `./_UI/MAIN_UI/api` to be created as a symbolic link to `./APIS/JSON-RPC`

#### ./APIS/JSON-RPC

The main API/Service Bus example, includes a test form to post data to the API, requires:

* `./APIS/JSON-RPC` to be http accessible


#### ./APIS/CLI

Command line interface with cron harness example, requires:

* execution be from the php command line api 









## Further Configuration of just-core 

  The configuration files are in `./CONFIG/AUTOLOAD/`

see [Configuration](Configuration) for further details

### Example (Virtual) Host directives
  * determine the base install you would like
 

#### typical api focused install

   * copy the stub directory into your own directory 
   * configure your web application server to allow access to this directory
    - set the virtual host configuration
	
```
<Directory [base_path]/[install_instance]/APIS/JSON-RPC>
	DirectoryIndex index.php
	AllowOverride All
	Order allow,deny
	Allow from all
	SetEnv APPLICATION_ENV "DEV"
</Directory>
```

#### typical website focused install

- create a directory called httpd in your base install 
- copy the contents of into your new httpd directory
- create a directory called /api/ in your httpd directory 
- copy the contents of JSON-RPC into your new httpd/api/ directory
    - set the virtual host configuration
	
```
<Directory [base_path]/[install_instance]/_UI/MAIN_UI>
	DirectoryIndex index.php
	AllowOverride All
	Order allow,deny
	Allow from all
	SetEnv APPLICATION_ENV "DEV"
</Directory>
```

#### typical command line focused install

- `[base_path]/[install_instance]/APIS/CLI`