<?php

namespace App\Repositories;

class HoroscopeRepository
{
    public function westernSign($month, $day)
    {
        switch( $month )
        {
            case '1':
                if( $day <= 19 )
                {
                    $zod = "Capricorn";
                }
                else
                {
                    $zod = "Aquarius";
                }
                break;
            case '2':
                if( $day <= 18 )
                {
                    $zod = "Aquarius";
                }
                else
                {
                    $zod = "Pisces";
                }
                break;
            case '3':
                if( $day <= 20 )
                {
                    $zod = "Pisces";
                }
                else
                {
                    $zod = "Aries";
                }
                break;
            case '4':
                if( $day <= 19 )
                {
                    $zod = "Aries";
                }
                else
                {
                    $zod ="Taurus";
                }
                break;
            case '5':
                if( $day <= 20 )
                {
                    $zod = "Taurus";
                }
                else
                {
                    $zod = "Gemini";
                }
                break;
            case '6':
                if( $day <= 20 )
                {
                    $zod = "Gemini";
                }
                else
                {
                    $zod = "Cancer";
                }
                break;
            case '7':
                if( $day <= 22 )
                {
                    $zod = "Cancer";
                }
                else
                {
                    $zod = "Leo";
                }
                break;
            case '8':
                if( $day <= 22 )
                {
                    $zod = "Leo";
                }
                else
                {
                    $zod = "Virgo";
                }
                break;
            case '9':
                if( $day <= 22 )
                {
                    $zod = "Virgo";
                }
                else
                {
                    $zod = "Libra";
                }
                break;
            case '10':
                if( $day <= 22 )
                {
                    $zod = "Libra";
                }
                else
                {
                    $zod = "Scorpio";
                }
                break;
            case '11':
                if( $day <= 21 )
                {
                    $zod = "Scorpio";
                }
                else
                {
                    $zod = "Sagittarius";
                }
                break;
            case '12':
                if( $day <= 21 )
                {
                    $zod = "Sagittarius";
                }
                else
                {
                    $zod = "Capricorn";
                }
                break;
            default:
                $zod = '';
                break;
        }
        
        return $zod;
    }

    public function chineseSign($year)
    {
        $sign = '';
        if( $year%12==2 ) : $sign = 'Dog'; endif;
        if( $year%12==8 ) : $sign = 'Dragon'; endif;
        if( $year%12==11 ) : $sign = 'Goat'; endif;
        if( $year%12==10 ) : $sign = 'Horse'; endif;
        if( $year%12==0 ) : $sign = 'Monkey'; endif;
        if( $year%12==5 ) : $sign = 'Ox'; endif;
        if( $year%12==3 ) : $sign = 'Pig'; endif;
        if( $year%12==4 ) : $sign = 'Rat'; endif;
        if( $year%12==1 ) : $sign = 'Rooster'; endif;
        if( $year%12==9 ) : $sign = 'Snake'; endif;
        if( $year%12==6 ) : $sign = 'Tiger'; endif;
        
        return $sign;
    }
}
