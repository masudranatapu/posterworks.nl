<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function dashboard()
    {
        $data['title'] = 'Dashboard';
        return view('admin.dashboard',compact('data'));
    }


    public function cacheClear(){
        \Artisan::call('route:clear');
        \Artisan::call('optimize');
        \Artisan::call('optimize:clear');
        \Artisan::call('view:clear');
        \Artisan::call('view:cache');
        \Artisan::call('config:clear');
        \Artisan::call('storage:link');
        // Artisan::call('cache:forget');
        \Artisan::call('cache:forget spatie.permission.cache');
        \Artisan::call('config:cache');

        return redirect()->route('admin.dashboard');

    }

}
