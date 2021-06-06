<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Auth;
use Session;

use App\Models\Rating;

class RatingController extends Controller
{

    public function list()
    {
        $ratings = Rating::where('owner_id', '=', Auth::user()->id)->get();
        return view('user.rating.list', compact('ratings'));
    }
    
    public function create(Request $request)
    {
        return view('user.rating.create');
    }

    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'score' => 'required',
            'url' => 'mimes:jpeg,jpg,png,gif|required|max:10000'
        ]);

        $url = '';
        if ($request->hasFile('url')) {
            $image = $request->file('url');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/smile', $filename
            );

            $url = 'smile/'. $filename;
        }

        $rating = Rating::create([
            'category_id' => 1,
            'name' => $request->name,
            'score' => $request->score,
            'content' => $url,
            'owner_id' => Auth::user()->id,
            'active' => 0,
        ]);
        
        if($rating) {
            return redirect()->route('user.rating.list');
        }
        else {
            return redirect()->back();
        }
    }   

    public function edit(Request $request) {
        $rating_id = $request->rating_id;
        $rating = Rating::find($rating_id);

        if($rating->active == 1) {
            Session::put("message", "This rating is running, you couldn't edit this rating!");
            return redirect()->back();
        }

        return view('user.rating.edit', compact('rating'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'score' => 'required'
        ]);

        if ($request->hasFile('url')) {
            $exist_url = Rating::find($request->rating_id)->content;

            $exist_file = 'public/' . $exist_url;
            if (Storage::exists($exist_file)) {
                Storage::delete($exist_file);
            }

            $image = $request->file('url');
            $filename = time().'.'.$image->guessExtension();
            
            $path = $image->storeAs(
                 'public/smile', $filename
            );

            $url = 'smile/'. $filename;
            
            $input = array(
                'name' => $request->name,
                'score' => $request->score,
                'content' => $url,
                'owner_id' => Auth::user()->id,
            );
        }
        else {
            $input = array(
                'name' => $request->name,
                'score' => $request->score,
                'owner_id' => Auth::user()->id,
                'active' => 0,
            );
        }
        
        $rating = Rating::find($request->rating_id)->update($input);
        if($rating) {
            return redirect()->route('user.rating.list');
        }
        else {
            return redirect()->back();
        }
    }

    public function delete(Request $request) {
        $rating_id = $request->rating_id;
        if($rating = Rating::find($rating_id)) {
            
            if($rating->active == 0) {
                $url = $rating->content;

                $file = 'public/' . $url;
                if (Storage::exists($file)) {
                    Storage::delete($file);
                }
                Rating::where('id', $rating_id)->delete();
                echo 'success';
            }
            else {
                echo 'running';
            }
        }
    }
}
