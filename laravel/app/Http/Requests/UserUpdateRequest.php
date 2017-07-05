<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class UserUpdateRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest {

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow access if the user logged in is web master or developer
        if( Auth::user()->hasRole( 'Web Developer' ) ) {
            $authorised = true;
        } elseif ( Auth::user()->hasRole( 'Web Master' ) ) {
            $authorised = true;
        } elseif ( Auth::user()->hasRole( 'Web Communication' ) ) {
            $authorised = false;
        } else {
            $authorised = false;
        }
        return $authorised;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      => 'Required|min:5|max:80|NotIn:php,ruby',
            'email'     => 'Required|Email',
            'civility'=> 'NotIn:php,ruby',
            'birthday'=> 'NotIn:php,ruby',
            'birth_location'=> 'NotIn:php,ruby',
            'phone'=> 'Numeric',
            // 'photo'=> '',
            'job'=> 'NotIn:php,ruby',
            'address'=> 'NotIn:php,ruby',
            'postal_code'=> 'Numeric',
            'city'=> 'NotIn:php,ruby',
            'family_id'=> 'Required',
            'jersey_nbr'=> 'integer',
        ];
    }

}