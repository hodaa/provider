## Providers
Collect data from json files to read and make some filter operations on them to get the result.

## Installation
* `docker-compose build`
* `docker-compose up`

If you got the problem of file permission ,you should go enter the php image
  `docker-compose exec php sh`
  then type `sudo chown -R www-data:www-data storage/`


## Example
We now have only two files located in "Data" folder.
If you want to add a new json file , you have to implement DataProvider  and add it to 
"DataParser" folder with the same name of the filename.

## Tools
* PHP7.4
* Lumen

## Testing
`vendor/bin/phpunit`
