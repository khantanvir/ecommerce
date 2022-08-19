<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Database\Seeders\RoleSeeder;
use Database\Seeders\AdminUserSeeder;

class ArtisanController extends Controller
{
    public function index(){

    }
    //migrate artisan 
    public function migrate(){
        Artisan::call('migrate');
        dd('database migrated');
    }
    //roll seeder
    public function roll_seeder(){
        Artisan::call('db:seed', array('--class' => "RoleSeeder"));
        dd('create roll for admin auth');
    }
    //admin seeder 
    public function admin_seeder(){
        Artisan::call('db:seed', array('--class' => "AdminUserSeeder"));
        dd('new admin created successfully!');
    }
    //cache clear
    public function cache_clear(){
        Artisan::call('cache:clear');
        dd("Cache is cleared");
    }
    //route clear
    public function route_clear(){
        Artisan::call('route:clear');
        dd("Route is cleared");
    }
    //config clear
    public function config_clear(){
        Artisan::call('config:clear');
        dd("Config is cleared");
    }
}