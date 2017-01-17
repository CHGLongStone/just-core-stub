# Included Scripts

## install.sh

Install/Update the application
* install composer
* run composer self-update
* run composer install
* run composer update
* execute further "installation" options

## create_release.sh
* run a schema diff between current and upstream environments
* run pre_release_check.sh
* check current and upstream application repository for changes
* fetch and merge upstream changes, push updates to origin integration and origin master
* create a release tag and push to origin 

## pre_release_check.sh
* check defined dependency repositories (your other packages) for local changes
* check for uncommitted changes in your defined working directories 
* run composer to verify no dependency upstream changes

# Supporting Scripts
## [just-core-scripts](https://github.com/CHGLongStone/just-core-scripts)