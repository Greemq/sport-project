<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Spatie\Image\Image;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('test_file_path', function () {
    $file_name = '7r0oPJC2smEgCykG1qpz.png';
    $this->info(public_path('storage'));
    Image::load(public_path('storage').'/news/'. $file_name)->width(100)->height(100)->save('/storage/news/_thumb' . $file_name);

});
