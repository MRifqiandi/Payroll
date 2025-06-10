<?php

namespace App\Helpers;

use App\Models\LogActivity;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    public static function log($action, $description = null, $level = 'info')
    {
        LogActivity::create([
            'users_id'   => Auth::id(),
            'action'     => $action,
            'level'      => $level,
            'description'=> $description,
        ]);
    }
}
