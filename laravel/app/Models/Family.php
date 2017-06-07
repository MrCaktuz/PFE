<?php

namespace App\Models;

use DB;
use App\User;
use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Family extends Model
{
    use CrudTrait;

     /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'families';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = [ 'name' ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */
    public function getFamilyMails()
    {
        $mails = 'mailto:';
        $usersNbr = $this->users->count();
        for ($i=0; $i < $usersNbr; $i++) { 
            $mail = $this->users[$i]['attributes']['email'];
            $mails = $mails . $mail . ';';
        }

        return $mails;
    }

    public function getSendMailButton()
    {
        $link = $this->getFamilyMails();
        $htmlCode = '<a class="btn btn-default btn-xs" href="' . $link . '"><i class="fa fa-envelope-o"></i> Envoyer un mail</a>';
        return $htmlCode;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */
    public function users(){
        return $this->hasMany( 'App\User', 'family_id', 'id' );
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope( 'ordered', function( Builder $builder ) {
            $builder->orderBy( 'name' );
        } );
    }

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
