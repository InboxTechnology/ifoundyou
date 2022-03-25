<?php

namespace App\Repositories;

use App\State;

class StateRepository
{
    public function all()
    {
    	return State::get();
    }

    public function getIDByName($stateName)
    {
    	return State::where('state_name', $stateName)->first();
    }
}
