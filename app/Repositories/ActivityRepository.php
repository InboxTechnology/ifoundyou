<?php

namespace App\Repositories;

use App\Activity;

class ActivityRepository
{
    public function all()
    {
    	return Activity::orderBy('activity_name', 'ASC')
                ->get();
    }
}
