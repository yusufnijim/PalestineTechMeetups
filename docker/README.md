# Palestine Tech Meetups website

PalestineTM backend site

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. See deployment for notes on how to deploy the project on a live system.

### Prerequisities

Docker + docker-compose


If you are not using docker for your development environment, please read this [README.md](src/README.md)

### Installing

To run this site:

1- Download source code:
```
$ git clone https://github.com/AminMkh/PalestineTechMeetups.git
```

2- Fire up the docker containers
```
$ docker-compose up -d
```

3- Install third party packages using composer:
```
$ docker-compose run web bash -c "./composer install -n"
```

4- Create the database using artisan:
```
$ docker-compose run web bash -c "php artisan migrate --seed"
```

5- Configure Laravel permissions:
```
$ sudo chmod 775 src/storage/ src/bootstrap/cache src/public/image -R
```

Walla, you rock !

## Contributing

Please read [CONTRIBUTING.md](CONTRIBUTING.md) for details on our code of conduct, and the process for submitting pull requests to us.

## Authors

* **Amin M** - *Initial work* - [Amin-M](https://github.com/amin-m)
