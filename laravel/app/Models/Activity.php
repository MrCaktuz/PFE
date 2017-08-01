<?php

namespace App\Models;

use DB;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'activities';
    protected $primaryKey = 'id';
    public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [
        'title', 'date', 'duty',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getActivities($date)
    {
        $activities = DB::table('activities') -> where('date','>', $date) -> orderby('date', 'DSC') -> get();
        if (count($activities) == null) {
            $activities->noActivity = "Il n'y a plus d'activité pour le moment.";
        } else {
            $activities->noActivity = false;
            $tools = new Tool;
            foreach ($activities as $activity) {
                // ******** Formate the date ********
                $activity->date = $tools->getFormatedDateForActivities($activity->date);
            }
        }

        return $activities;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
