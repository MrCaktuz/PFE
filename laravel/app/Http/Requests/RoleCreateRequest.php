<?php

namespace App\Http\Requests;

use Auth;
use App\Http\Requests\Request;

class RoleCreateRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
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
            'title' => 'Required|max:50|Unique:roles',
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            //
        ];
    }
}
