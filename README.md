# Nablus Tech Meetups website

NTM backend site

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisities

Docker + docker-compose

### Installing

To run this site:

1- Download source code:
```
$ git clone https://github.com/NablusTechMeetups/web.git
```

2- Fire up the docker containers
```
$ docker-compose up
```

3- Install third party packages using composer:
```
$ docker-compose run web bash -c "cd /var/www/; ./composer install -vvv -n"
```

4- Create the database using artisan:
```
$ docker-compose run web bash -c "cd /var/www/; php artisan migrate --seed"
```

5- Configure Laravel permissions:
```
$ sudo chmod 777 src/storage/ src/bootstrap/cache src/public/userimages -R
```

Walla, you rock !

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Amin M** - *Initial work* - [Amin-M](https://github.com/amin-m)