<?php

use \Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User\UserModel;

class BlogTest extends TestCase
{
    use DatabaseTransactions;

    protected $blog;

    public function setUp()
    {
//        $this->blog = new \App\Repositories\Eloquent\BlogRepositoryEloquent();
        factory(App\Models\User\UserModel::class, 3)->create();
    }

    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testCreateBlogTest()
    {
        $this->assertEquals(123, 123);

        // Given


        // When
        // Then

    }

}