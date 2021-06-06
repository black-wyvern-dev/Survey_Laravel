<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Branchs;
use App\Models\User;
use  Auth;

class BranchController extends Controller
{
    public function validateBranch(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:127|min:3|unique:branchs',
        ]);
    }

    public function list()
    {   
        $branchs = Branchs::getAllByOwner(Auth::user()->id);
        return view('user.branch.list', compact('branchs'));
    }
    public function create(Request $request)
    {
        $managers = User::where('parent_id', Auth::user()->id)->where('role', 3)->get();
        return view('user.branch.create', compact('managers'));
    }
    public function save(Request $request)
    {
        $this->validateBranch($request);

        $picture = '';
        if($request->has('picture')) {
            $image = $request->file('picture');
            $fileName = time().'.'.$image->guessExtension();
            $path = $image->storeAs(
                    'public/branch', $fileName
            );

            $picture = 'branch/'. $fileName;
        }
        $branch = new Branchs();

        $branch->name = $request->name;
        $branch->country = $request->country;
        $branch->city = $request->city;
        $branch->picture = $picture;
        $branch->owner_id = Auth::user()->id;
        $branch->manager_id = $request->manager_id;

        $branch->save();
        if($branch)
        {
            return redirect()->route('user.branch.list');
        }
        else {
            return redirect()->back();
        }
    }

    /**
     * Edit the branch
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $branch_id = $request->branch_id;
        $branch = Branchs::find($branch_id);
        $managers = User::where('parent_id', Auth::user()->id)->get();
        return view('user.branch.edit', compact('branch', 'managers'));
    }
    /**
     * Update the branch.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        //$this->validateBranch($request);
        $update = Branchs::find($request->branch_id);
        $picture = '';
        
        if($request->hasFile('picture')) {
            
            $exist_picture = $update->picture;
            if($exist_picture != '') {
                $file = 'public/' . $exist_picture;
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
            }
            $image = $request->file('picture');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/branch', $filename
            );

            $picture = 'branch/'. $filename;
            $update->picture = $picture;
        }
        if($request->name) {
            $update->name = $request->name;
        }
        if($request->country) {
            $update->country = $request->country;
        }
        if($request->city) {
            $update->city = $request->city;
        }
        if($request->manager_id)
        {
            $update->manager_id = $request->manager_id;
        }

        // $branch = Branchs::find($request->branch_id)->update($update);
        $update->save();
        if($update) 
        {
            return redirect()->route('user.branch.list');
        }
        else {
            //return redirect()->back();
        }
    }

    public function destroy(Request $request)
    {
        $deleted = Branchs::destroy($request->id);
        
        if(!$deleted) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        return response()->json(['message' => 'Successfully Removed'], 200);
    }

    public function getAllByOwner(Request $request)
    {
        $branchs = Branchs::getAllByOwner(Auth::user()->id);

        return response()->json($branchs);
    }
}
