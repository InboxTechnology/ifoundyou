<?php

namespace App\Repositories;

class LifePathNumberRepository
{
    public function lifePathNumber($num)
    {
        if( $num!=11 && $num!=22 )
        {
            $sum = array_sum(str_split($num));
            if( $sum>=10 && $sum!=11 && $sum!=22 )
            {
                return $this->lifePathNumber($sum);
            }
            else
            {
                return $sum;
            }
        }
        else
        {
            return $num;
        }
    }
}
