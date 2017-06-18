<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserCreateRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        // return $auth->user()->hasRole('Web Master');
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=> 'Required|min:5|max:80|NotIn:php,ruby',
            'email'=> 'Required|Email|Unique:users',
            'password'=>'Required|AlphaNum|Between:4,8|Confirmed',
            'password_confirmation'=>'Required|AlphaNum|Between:4,8',
            // 'civility'=> 'NotIn:php,ruby',
            // 'birthday'=> 'NotIn:php,ruby',
            // 'birth_location'=> 'NotIn:php,ruby',
            // 'phone'=> 'Numeric',
            // 'photo'=> '',
            // 'job'=> 'NotIn:php,ruby',
            // 'address'=> 'NotIn:php,ruby',
            // 'postal_code'=> 'Numeric',
            // 'city'=> 'NotIn:php,ruby',
            'family_id'=> 'Required',
            'jersey_nbr'=> 'integer',
        ];
    }

}