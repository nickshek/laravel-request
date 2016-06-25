<?php

namespace LaravelRequest\Middleware;

use Closure;

class LogAfterRequest {

    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    public function terminate($request,$response)
    {
        $request_model_name = config("laravel-request.model");
        $request_model = new $request_model_name();
        $request_model->response = $response->getStatusCode();
        $request_model->method = $request->getMethod();
        $request_model->path = $request->getUri();
        $request_model->is_secure = $request->isSecure();
        $request_model->is_ajax = $request->ajax();
        $request_model->ip = $request->getClientIp();
        $request_model->user_id = $request->user()?$request->user()->id:null;
        $request_model->referer = $request->server('HTTP_REFERER');
        $request_model->user_agent = $request->server('HTTP_USER_AGENT');
        $request_model->language = config('app.locale');;
        $request_model->save();
    }

}
