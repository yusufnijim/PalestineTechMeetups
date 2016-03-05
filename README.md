Nablus Tech Meetups website

To run this site:

1- Download source code:
	git clone https://AminCo@bitbucket.org/AminCo/ntm.git

2- Fire up the docker containers
	$ docker-compose up

3- Install third party packages using composer:

    $ docker-compose run web bash -c "cd /var/www/; ./composer install -vvv -n"

4- Create the database using artisan:
	$ docker-compose run web bash -c "cd /var/www/; php artisan migrate"

5- Configure Laravel permissions:

    $ chmod 777 src/storage/ src/bootstrap/cache -R


Walla, you rock !

