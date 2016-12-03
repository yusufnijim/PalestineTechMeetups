<?php

class LanguageTest extends TestCase {

    protected $baseUrl = 'http://localhost';

    /**
     * A basic functional test should return a home page with arabic language.
     *
     * @return void
     */
    public function testShouldReturnHomeWithArabicLanguage()
    {
        $this->visit('/language/ar')
            ->see('Events')
            ->dontSee('welcome');
    }
    /**
     * A basic functional test should return a home page with english language.
     *
     * @return void
     */
    public function testShouldReturnHomeWithEnglishLanguage()
    {
        $this->visit('/language/en')
            ->see('Welcome');
    }


    /**
     * A basic functional test should return a 404 error page, because we are trying access an invalid language url
     * made with a number language argument.
     *
     * @return void
     */
//    public function testShouldReturn404ErrorPage()
//    {
//        $response = $this->call('GET', '/language/123');
//        $this->assertEquals(404, $response->status());
//    }
}