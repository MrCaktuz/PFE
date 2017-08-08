<?php

namespace App\Http\Controllers;

use DB;
use URL;
use Storage;
use App\User;
use App\Models\Tool;
use App\Models\Role;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Backpack\CRUD\app\Http\Controllers\CrudController;

class UserController extends Controller
{
	public function index()
	{
        $users = User::all();
		return view('user.index', compact( 'users' ));
	}

    public function show(User $user)
    {
        $tools = new Tool;
        // ******** Get formated birthday ********
        $user->birthday = $tools->getFormatedDate($user->birthday);
        // ******** Get photo src ********
        $user->src = $user->getPhotoSrc($user);
        // ******** Get photo srcset ********
        $user->srcset = $user->getPhotoSrcset($user);
        // ******** Get family ********
        $user->family = $user->getFamily($user->family_id);
        // ******** Get teams coached ********
        $user->teams = $user->getTeamCoached($user->id);

        return view('user.show', compact('user'));
    }

    public function edit(User $user)
    {
        // ******** Get photo src ********
        $user->src = $user->getPhotoSrc($user);
        // ******** Get photo srcset ********
        $user->srcset = $user->getPhotoSrcset($user);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this -> validate( $request, [
            'name'             => 'Required|max:80|NotIn:php,ruby',
            'email'            => 'Required|Email',
            'civility'         => 'NotIn:php,ruby',
            'birthday'         => 'NotIn:php,ruby',
            'birthLocation'    => 'NotIn:php,ruby',
            'phone'            => 'Numeric|nullable',
            'job'              => 'NotIn:php,ruby',
            'address'          => 'NotIn:php,ruby',
            'postalCode'       => 'Numeric|nullable',
            'city'             => 'NotIn:php,ruby',
            'jersey'           => 'integer',
        ] );
        // ******** Upload file to DB ********
        // if( $request->hasFile('img') ) {
        //     $file = $request->file('img');
        // }
        // $fileName = md5($file.time());
        // $destinationPath = public_path().'/uploads/users';
        // $file->move($destinationPath, $fileName.'.jpg');
        // ******** Attribute data to user ********
        $user->civility = $request->civility;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->birthday = $request->birthday;
        $user->birth_location = $request->birthLocation;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->postal_code = $request->postalCode;
        $user->city = $request->city;
        $user->national_id = $request->nationalID;
        $user->job = $request->job;
        $user->jersey_nbr = $request->jersey;
        // $user->photo = URL::to('/').'/uploads/users/'.$fileName.'.jpg';
        // ******** Update data ********
        $user->update();
        
        return redirect() -> route( 'profil', [ 'id' => $user->id ] );
    }

    public function Trainer()
    {
        // ******** Get the introduction ********
        $DB_intro = DB::table('trainer') -> select('value') -> where('key', 'intro') -> get();
        $intro = $DB_intro[0]->value;
        // ******** Get all trainers ********
        $user = new User;
        $trainers = $user -> getAllTrainers();

        return view('trainer', compact('intro', 'trainers'));
    }

    public function comity()
    {
        // ******** Get the introductions ********
        $DB_sloganCA = DB::table('comity') -> select('value') -> where('key', 'intro_ca') -> get();
        $sloganCA = $DB_sloganCA[0]->value;
        $DB_sloganACA = DB::table('comity') -> select('value') -> where('key', 'intro_aca') -> get();
        $sloganACA = $DB_sloganACA[0]->value;
        // ******** Get all CA members ********
        $user = new User;
        $membersCA = $user -> getCAmembers();
        $membersACA = $user -> getACAmembers();

        return view('comity', compact('sloganCA', 'sloganACA', 'membersCA', 'membersACA'));
    }
}
