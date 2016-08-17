<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $permissions = [
            // events
            [
                'name' => 'event.edit',
                'category' => 'Events',
            ],
            [
                'name' => 'event.create',
                'category' => 'Events',
            ],
            [
                'name' => 'event.delete',
                'category' => 'Events',
            ],
            [
                'name' => 'event.view',
                'category' => 'Events',
            ],

            // blogs
            [
                'name' => 'blog.create',
                'category' => 'Blogs',
            ],
            [
                'name' => 'blog.view',
                'category' => 'Blogs',
            ],
            [
                'name' => 'blog.edit',
                'category' => 'Blogs',
            ],
            [
                'name' => 'blog.delete',
                'category' => 'Blogs',
            ],

            // users
            [
                'name' => 'user.create',
                'category' => 'Users',
            ],
            [
                'name' => 'user.view',
                'category' => 'Users',
            ],
            [
                'name' => 'user.edit',
                'category' => 'Users',
            ],
            [
                'name' => 'user.delete',
                'category' => 'Users',
            ],

            // roles
            [
                'name' => 'role.create',
                'category' => 'Roles',
            ],
            [
                'name' => 'role.view',
                'category' => 'Roles',
            ],
            [
                'name' => 'role.edit',
                'category' => 'Roles',
            ],
            [
                'name' => 'role.delete',
                'category' => 'Roles',
            ],

        ];

        Schema::create('permission', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->string('category')->nullable();
            $table->timestamps();
        });

        foreach ($permissions as $permission) {
            DB::table('permission')->insert([
                'name' => $permission['name'],
                'category' => $permission['category'],
            ]);
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('permission');
    }
}
