<?php

namespace App\Models;

use Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use DOMDocument;      

class Tool extends Model
{
    public function getFormatedTime($time)
    {
        $grossTime = $time;
        $timeSplited = preg_split('/:/', $grossTime);
        $timeHour = $timeSplited[0];
        $timeMinute = $timeSplited[1];
        $timeFormated = $timeHour.'h'.$timeMinute;

        return $timeFormated;
    }

    public function getFormatedDate($date)
    {
        $dateSplited = preg_split( '/-/', $date );
        $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        $dateYear = $dateSplited[0];
        $dateMonth = $months[intval($dateSplited[1])-1];
        $dateDay = $dateSplited[2];
        $dateFormated = $dateDay.' '.$dateMonth.' '.$dateYear;
        $date = $dateFormated;

        return $date;
    }

    public function getFormatedDateFromTimestamps($date)
    {
        $dateSplited = preg_split( '/ /', $date );
        $dateSplited = preg_split( '/-/', $dateSplited[0] );
        $months = ['janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre'];
        $dateYear = $dateSplited[0];
        $dateMonth = $months[intval($dateSplited[1])-1];
        $dateDay = $dateSplited[2];
        $dateFormated = $dateDay.' '.$dateMonth.' '.$dateYear;
        $date = $dateFormated;

        return $date;
    }

    public function getFormatedDateForActivities($date)
    {
        $dateSplited = preg_split( '/-/', $date );
        $months = ['jan', 'fév', 'mars', 'avr', 'mai', 'juin', 'juil', 'août', 'sept', 'oct', 'nov', 'déc'];
        $dateMonth = $months[intval($dateSplited[1])-1];
        $dateDay = $dateSplited[2];
        $date = [$dateDay, $dateMonth];

        return $date;
    }

    public function getBodyClass()
    {
        $body_classes = [];
        $class = "";

        foreach ( Request::segments() as $segment ) {
            if ( is_numeric( $segment ) || empty( $segment ) ) {
                 continue;
            }    
            $class .= ! empty( $class ) ? "-" . $segment : 'page-'.$segment;
            array_push( $body_classes, $class );
        }

        return ! empty( $body_classes ) ? implode( ' ', $body_classes ) : NULL;
    }
}