<?php

namespace App\Providers;

use DB;
use App\Models\Tool;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // ******** Get page title on every view ********
        $title = "";
        View::share('pageTitle', $title);
        
        // ******** Get the address on every view ********
        $DB_address = DB::table('settings') -> select('value') -> where('key', 'address') -> get();
        $address = $DB_address[0]->value;
        $addressSplited = preg_split( '/,/', $address );
        $addressStreet = $addressSplited[0];
        $addressNumber = $addressSplited[1];
        $addressPostalCode = $addressSplited[2];
        $addressCity = $addressSplited[3];
        View::share('addressStreet', $addressStreet);
        View::share('addressNumber', $addressNumber);
        View::share('addressPostalCode', $addressPostalCode);
        View::share('addressCity', $addressCity);

        // ******** Get the contact email on every view ********
        $DB_contactEmail = DB::table('settings') -> select('value') -> where('key', 'contact_email') -> get();
        $contactEmail = $DB_contactEmail[0]->value;
        View::share('contactEmail', $contactEmail);

        // ******** Get the contact email on every view ********
        $DB_contactCC = DB::table('settings') -> select('value') -> where('key', 'contact_cc') -> get();
        $contactCC = $DB_contactCC[0]->value;
        View::share('contactCC', $contactCC);

        // ******** Get the facebook link on every view ********
        $DB_facebook = DB::table('settings') -> select('value') -> where('key', 'facebook') -> get();
        $facebook = $DB_facebook[0]->value;
        View::share('facebook', $facebook);

        // ******** Get the insta link on every view ********
        $DB_insta = DB::table('settings') -> select('value') -> where('key', 'insta') -> get();
        $insta = $DB_insta[0]->value;
        View::share('insta', $insta);

        // ******** Get the twitter link on every view ********
        $DB_twitter = DB::table('settings') -> select('value') -> where('key', 'twitter') -> get();
        $twitter = $DB_twitter[0]->value;
        View::share('twitter', $twitter);

        // ******** Get body class on every view ********
        $tool = new Tool;
        $bodyClass = $tool->getBodyClass();
        View::share('bodyClass', $bodyClass);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
