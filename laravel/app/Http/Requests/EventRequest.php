<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EventRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow access if the user logged in is web master, developer or communication
        if( Auth::user()->hasRole( 'Web Communication' ) ) {
            $authorised = true;
        } elseif ( Auth::user()->hasRole( 'Web Master' ) ) {
            $authorised = true;
        } elseif ( Auth::user()->hasRole( 'Web Communication' ) ) {
            $authorised = true;
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
            'title' => 'Required|min:5|max:255|NotIn:php,ruby',
            'description' => 'Required|NotIn:php,ruby',
            'photo' => 'Mimes:jpg',
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
