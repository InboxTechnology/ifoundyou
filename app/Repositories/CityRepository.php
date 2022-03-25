<?php

namespace App\Repositories;

use App\City;

class CityRepository
{
    public function all( $status='', $stateID='', $countryID='' )
    {
    	$cities = City::orderBy('city_name', 'ASC');

    	if( $status!='' )
    	{
    		$cities->where('city_status', $status);
    	}

    	if( $stateID!='' )
    	{
    		$cities->where('state_id', $stateID);
    	}

        if( $countryID!='' )
        {
            $cities->where('country_id', $countryID);
        }

    	return $cities->get();
    }

    public function getIDByName($cityName, $stateID=0, $countryID=0)
    {
        $cities = City::where('city_name', $cityName);

        if( $stateID>0 )
        {
            $cities->where('state_id', $stateID);
        }

        if( $countryID>0 )
        {
            $cities->where('country_id', $countryID);
        }

        return $cities->first();
    }
}
