## Providers
Collect data from json files to read and make some filter operations on them to get the result.
Files are located in data folder at the root of the folder

## Installation
* `docker-compose build`
* `docker-compose up`
* `docker-compose exec php sh`
* `composer install`



## Example
We now have only two files located in "Data" folder.
If you want to add a new json file , you have to implement DataProvider  and add it to 
"DataParser" folder with the same name of the filename.

## API
    `http://localhost:8081/api/v1/users`


## Tools
* PHP7.4
* Lumen
* phpunit

## Testing
`vendor/bin/phpunit`
