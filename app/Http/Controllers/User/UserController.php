<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Auth;

use App\Models\User;
use App\Models\Branchs;

class UserController extends Controller
{

    public function list()
    {
        $users = User::where('parent_id', '=', Auth::user()->id)->get();
        return view('user.user.list', compact('users'));
    }
    
    public function create(Request $request)
    {
        $branchs = Branchs::getAllByOwner(Auth::user()->id);
        return view('user.user.create', compact('branchs'));
    }

    public function save(Request $request) {
        $this->validate($request, [
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
            'branch' => 'required'
        ]);

        $photo = '';
        if ($request->hasFile('photo')) {
            $image = $request->file('photo');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/avatar', $filename
            );

            $photo = 'avatar/'. $filename;
        }

        $active = 0;
        if($request->active != '0') {
            $active = 1;
        }

        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'photo' => $photo,
            'employeeId' => Uuid::generate(4),
            'parent_id' => Auth::user()->id,
            'role' => $request->role,
            'branch' => $request->branch,
            'active' => $active,
        ]);
        
        if($user->role == 3)
        {
            Branchs::updatedByUser($user->branch, $user->id);
        }

        if($user) {
            return redirect()->route('user.user.list');
        }
        else {
            return redirect()->back();
        }
    }   

    public function edit(Request $request) {
        $user_id = $request->user_id;
        $user = User::find($user_id);

        $branchs = Branchs::getAllByOwner(Auth::user()->id);

        return view('user.user.edit', compact('user', 'branchs'));
    }

    public function update(Request $request) {
        if($request->password) {
            $validate_rule = array(
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
                'password' => 'confirmed|min:6',
                'branch' => 'required'
            );
        }
        else {
            $validate_rule = array(
                'firstName' => 'required',
                'lastName' => 'required',
                'email' => 'required|email',
                'password' => 'confirmed',
                'branch' => 'required'
            );
        }

        $this->validate($request, $validate_rule);

        $photo = '';
        if ($request->hasFile('photo')) {
            $exist_photo = User::find($request->user_id)->photo;
            if($exist_photo != '') {
                $file = 'public/' . $exist_photo;
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }

            $image = $request->file('photo');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/avatar', $filename
            );

            $photo = 'avatar/'. $filename;
        }

        $active = 0;
        if($request->active != '0') {
            $active = 1;
        }

        if($request->password) {
            $input = array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'photo' => $photo,
                'role' => $request->role,
                'branch' => $request->branch,
                'active' => $active
            );
        }
        else {
            $input = array(
                'firstName' => $request->firstName,
                'lastName' => $request->lastName,
                'email' => $request->email,
                'photo' => $photo,
                'role' => $request->role,
                'branch' => $request->branch,
                'active' => $active
            );
        }
        $user = User::find($request->user_id)->update($input);
        $update = User::find($request->user_id);
        if($update->role == 3)
        {
            Branchs::updatedByUser($update->branch, $update->id);
        }
        if($user)
        {   
            if($request->role == 3)
            {
                Branchs::updatedByUser($request->branch, $request->user_id);
            }
        }

        if($user) {
            return redirect()->route('user.user.list');
        }
        else {
            return redirect()->back();
        }
    }

    public function delete(Request $request) {
        $user_id = $request->user_id;
        if($user = User::find($user_id)) {
            $photo = $user->photo;

            $file = 'public/' . $photo;
            if (Storage::exists($file)) {
                Storage::delete($file);
            }
            User::where('id', $user_id)->delete();
            echo 'success';
        }
    }

    public function profile() {
        $user = Auth::user();
        $branches = Branchs::all();
        return view('user.user.profile', compact('user', 'branches'));
    }

    public function avatarUpload(Request $request) {
        if ($request->photo) {
            $exist_photo = User::find(Auth::user()->id);
            if($exist_photo != '') {
                $file = 'public/' . $exist_photo;
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }

            $image = $request->file('photo');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/avatar', $filename
            );

            $photo = 'avatar/'. $filename;

            $user = Auth::user();
            $user->photo = $photo;
            $user->save();
            echo 'success';
        }

    }

    public function updateProfile(Request $request) {
        $validate_rule = array(
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'password' => 'confirmed'
        );

        $this->validate($request, $validate_rule);

        $input = array(
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'photo' => $photo,
            'active' => 1
        );
        
        $user = User::find($request->user_id)->update($input);
        return redirect()->back();
    }

    public function resetPwd(Request $request) {
        $validate_rule = array(
            'password' => 'required|confirmed|min:6',
        );

        $this->validate($request, $validate_rule);

        $user = User::find($request->user_id);
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back();
    }
}
