<?php

return [
  /*
  |--------------------------------------------------------------------------
  | Request Model
  |--------------------------------------------------------------------------
  |
  | When using the "LogAfterRequest" trait from this package, we need to know which
  | Eloquent model should be used to create request log in database. Of course, it
  | is often just the "Request" model but you may use whatever you like.
  |
  |
  */
  "model" => \LaravelRequest\Models\Request::class,

  /*
   |--------------------------------------------------------------------------
   | Table Name
   |--------------------------------------------------------------------------
   |
   | When using the "CreateRequestsTable" migration from this package, we need to know
   | the table name that will be created in the database. We have chosen a basic
   | default value but you may easily change it to any table you like.
   |
   */
  "table_name" => "requests",
];
