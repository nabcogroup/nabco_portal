<?php


namespace Libs;


use Illuminate\Support\ServiceProvider;
use Libs\Supports\Result;

class LibraryProvider extends ServiceProvider
{
    public function boot() {

    }

    public function register() {


        $this->app->singleton('Result',function() {
            new Result();
        });
    }

}