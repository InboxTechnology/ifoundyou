<?php

namespace App\Repositories;

use App\Cafe;

class CafeRepository
{
    public function all($cityID=0, $stateID=0, $countryID=0)
    {
    	$cafes = Cafe::orderBy('store_name', 'ASC');

        if( $cityID>0 )
        {
            $cafes->where('city_id', $cityID);
        }

    	if( $stateID>0 )
        {
            $cafes->where('state_id', $stateID);
        }

        if( $countryID>0 )
        {
            $cafes->where('country_id', $countryID);
        }

    	return $cafes->get();
    }

    public function getByIDs($cityID=0, $stateID=0, $countryID=0)
    {
        $cafes = Cafe::orderBy('store_name', 'ASC');

        if( $cityID>0 )
        {
            $cafes->where('city_id', $cityID);
        }

        if( $stateID>0 )
        {
            $cafes->where('state_id', $stateID);
        }

        if( $countryID>0 )
        {
            $cafes->where('country_id', $countryID);
        }

        return $cafes->first();
    }
}
