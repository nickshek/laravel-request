<?php

namespace LaravelRequest\Test\Middleware;

use Orchestra\Testbench\TestCase;
use LaravelRequest\Middleware\LogAfterRequest;
use LaravelRequest\Test\Mock\Models\MockRequest;

class LogAfterRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        MockRequest::clear();
        $this->app['router']->group(['middleware' => LogAfterRequest::class], function () {
            $this->app['router']->get('test', function () {
                return 'Hello world!';
            });
        });
        $results = MockRequest::getAllRecords();
        $this->assertSame(array(),$results);
    }

  /**
   * Define environment setup.
   *
   * @param  \Illuminate\Foundation\Application  $app
   */
  protected function getEnvironmentSetUp($app)
  {
      $app['config']->set('laravel-request.model', MockRequest::class);
  }

    public function testLogRequest()
    {
        $response = $this->call('get', 'test');
        $results = MockRequest::getAllRecords();
        $expect = new MockRequest();
        $expect->response = 200;
        $expect->method = "GET";
        $expect->path = 'http://localhost/test';
        $expect->is_secure = false;
        $expect->is_ajax = false;
        $expect->ip = '127.0.0.1';
        $expect->user_id = null;
        $expect->referer = null;
        $expect->user_agent = 'Symfony/3.X';
        $expect->language = 'en';

        $this->assertEquals(array(
          $expect
        ),$results);
    }
}
