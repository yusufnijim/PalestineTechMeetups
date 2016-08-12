<?php

namespace App\Providers;

use App\Repositories\Contracts\BlogRepository;
use App\Repositories\Contracts\ContactRepository;
use App\Repositories\Contracts\Event\EventRepository;
use App\Repositories\Contracts\Event\RegistrationRepository;
use App\Repositories\Contracts\Event\VolunteerRepository;
use App\Repositories\Contracts\Survey\SurveyRepository;
use App\Repositories\Contracts\User\UserRepository;
use App\Repositories\Eloquent\BlogRepositoryEloquent;
use App\Repositories\Eloquent\ContactRepositoryEloquent;
use App\Repositories\Eloquent\Event\EventRepositoryEloquent;
use App\Repositories\Eloquent\Event\RegistrationRepositoryEloquent;
use App\Repositories\Eloquent\Event\VolunteerRepositoryEloquent;
use App\Repositories\Eloquent\Survey\SurveyRepositoryEloquent;
use App\Repositories\Eloquent\User\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class DatabaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EventRepository::class, EventRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(VolunteerRepository::class, VolunteerRepositoryEloquent::class);
        $this->app->bind(BlogRepository::class, BlogRepositoryEloquent::class);
        $this->app->bind(SurveyRepository::class, SurveyRepositoryEloquent::class);
        $this->app->bind(RegistrationRepository::class, RegistrationRepositoryEloquent::class);
        $this->app->bind(ContactRepository::class, ContactRepositoryEloquent::class);
    }
}
