<?php

namespace LaravelRequest\Test\Mock\Middleware;

use LaravelRequest\Middleware\LogAfterRequest;

class LogAfterRequestExceptAdmin extends LogAfterRequest
{
  /**
  * @return bool
  */
  protected function shouldLogRequest($request, $response)
  {
    return $request->segment(1) !== 'admin';
  }
}
