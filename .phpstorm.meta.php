<?php

namespace PHPSTORM_META {

    // Model
    override(\Illuminate\Database\Eloquent\Model::query(), map([
        '' => '\Illuminate\Database\Eloquent\Builder',
    ]));

    // Mail
    override(\Illuminate\Support\Facades\Mail::send(), map([
        '' => '\Illuminate\Mail\Mailer',
    ]));

    // Route
    override(\Illuminate\Support\Facades\Route::getFacadeRoot(), map([
        '' => '\Illuminate\Routing\Router',
    ]));

    // DB
    override(\Illuminate\Support\Facades\DB::connection(), map([
        '' => '\Illuminate\Database\Connection',
    ]));

    // Cache
    override(\Illuminate\Support\Facades\Cache::store(), map([
        '' => '\Illuminate\Cache\Repository',
    ]));

    // Config
    override(\Illuminate\Support\Facades\Config::getFacadeRoot(), map([
        '' => '\Illuminate\Config\Repository',
    ]));

    // Session
    override(\Illuminate\Support\Facades\Session::getFacadeRoot(), map([
        '' => '\Illuminate\Session\SessionManager',
    ]));

    // Request
    override(\Illuminate\Support\Facades\Request::getFacadeRoot(), map([
        '' => '\Illuminate\Http\Request',
    ]));

    // Response
    override(\Illuminate\Support\Facades\Response::getFacadeRoot(), map([
        '' => '\Illuminate\Http\Response',
    ]));
}
