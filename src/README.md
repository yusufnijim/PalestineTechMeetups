# Nablus Tech Meetups website

## Installing without docker

To run this site:

1- Download source code:

```
$ git clone https://github.com/NablusTechMeetups/web.git
```

2- Install third party packages using composer:
```
$ composer install -vvv -n
```

3- Create the database using artisan:
```
php artisan migrate --seed
```

4- Configure Laravel permissions:

```
$ sudo chmod 775 storage/ bootstrap/cache public/userimages -R
```

Walla, you rock !
