<?php

namespace LaravelRequest\Test\Middleware;

use Orchestra\Testbench\TestCase;
use LaravelRequest\Middleware\LogAfterRequest;
use LaravelRequest\Test\Mock\Middleware\LogAfterRequestExceptAdmin;
use LaravelRequest\Test\Mock\Models\MockRequest;
use Exception;

class LogAfterRequestTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->app['router']->group(['middleware' => LogAfterRequest::class], function () {
            $this->app['router']->get('test', function () {
                return 'Hello world!';
            });
        });

        $this->app['router']->group(['middleware' => LogAfterRequestExceptAdmin::class], function () {
            $this->app['router']->post('test2', function () {
                return 'test2 page';
            });
        });

        $this->app['router']->group(['middleware' => LogAfterRequestExceptAdmin::class], function () {
            $this->app['router']->get('admin/test2', function () {
                return 'admin test2 page';
            });
        });

        MockRequest::clear();
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

    public function testLogAfterRequestGetUrl()
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

        $this->assertEquals(200,$response->status());
        $this->assertEquals('Hello world!',$response->content());
    }

    public function testLogAfterRequestExceptAdminShouldLogRequestEqualToTrue()
    {
        $response = $this->call('post', 'test2');
        $results = MockRequest::getAllRecords();
        $expect = new MockRequest();
        $expect->response = 200;
        $expect->method = "POST";
        $expect->path = 'http://localhost/test2';
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

        $this->assertEquals(200,$response->status());
        $this->assertEquals('test2 page',$response->content());
    }

    public function testLogAfterRequestExceptAdminShouldLogRequestEqualToFalse()
    {
        $response = $this->call('get', 'admin/test2');
        $results = MockRequest::getAllRecords();
        $this->assertEquals(array(),$results);

        $this->assertEquals(200,$response->status());
        $this->assertEquals('admin test2 page',$response->content());
    }
}
