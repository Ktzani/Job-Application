# Starting the DB - mysql
up: 
	./vendor/bin/sail up -d

# Stop the DB - mysql
stop: 
	./vendor/bin/sail stop

start-server:
	php artisan serve

migrate: 
	php artisan migrate

seed: 
	php artisan migrate:refresh --seed

