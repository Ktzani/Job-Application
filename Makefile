# Starting the DB - mysql
up: 
	./vendor/bin/sail up -d

# Stop the DB - mysql
stop: 
	./vendor/bin/sail stop

# root:
# 	./vendor/bin/sail root-shell

start-server:
	php artisan serve