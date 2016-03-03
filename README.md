# NablusTechMeetups / web
Nablus Tech Meetups website

To run this site:

1- Download source code
	git clone https://AminCo@bitbucket.org/AminCo/ntm.git
2- Fire up the docker containers
	$ docker-compose up
3- Install third party packages using composer
	$ composer install -vvv
4- Configure your database
	.env file
5- Create the database using artisan
	$ php artisan migrate

Walla, you rock !


Next tasks:
    - News CRUD
    - Search on users (registration model, view registered users page)
    - ACL

    - Design
    - QA
    - Feedback

#limit 100 set max number of registrars

#is_accepted

before registering for event, custom fields

    organizers
    volunteers
    speakers
    mentors

send emails to all users, or only accepted ones
statistics

news or blog


