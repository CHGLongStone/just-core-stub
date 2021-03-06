# Included Scripts

Scripts require the correct arguments to execute or they will return a usage description. 




## install.sh

Install/Update the application

* install composer
* run composer self-update
* run composer install
* run composer update
* install the database stub sql or execute another sql file
* over write ./CONFIG/AUTOLOAD/data.global.php
* create OR over write ./CONFIG/AUTOLOAD/data.local.php
  * excluded from source control


## pre_release_check.sh

* check defined dependency repositories (your other packages) for local changes
* check for uncommitted changes in your defined working directories 
* run composer to verify no dependency upstream changes
  
## create_release.sh

* run a schema diff between current and upstream environments
* run pre_release_check.sh
* check current and upstream application repository for changes
* fetch and merge upstream changes, push updates to origin integration and origin master
* create a release tag and push to origin 

## cfg_settings.sh

Environment settings for the release scripts. Source script, does NOT execute any changes.

* WORKING_DIRS
  * directories that must/should be checked for changes 
* JCORE_DEP_DIR_LIST
  * just-core dependency directory list if you're using composer to bring in your own upstream repositories you can check them for local changes

# Supporting Scripts

## [just-core-scripts](https://chglongstone.github.io/just-core-scripts)