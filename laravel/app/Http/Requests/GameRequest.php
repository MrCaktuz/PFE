<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class GameRequest extends \Backpack\CRUD\app\Http\Requests\CrudRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
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
            'team_id' => 'Required',
            'game_id' => 'Required',
            'date' => 'Required',
            'time' => 'Required',
            'Appointment' => '',
            'host' => 'Required',
            'visitor' => 'Required',
            'score' => '',
            'duty' => '',
            'day_id' => '',
            'location' => '',
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
