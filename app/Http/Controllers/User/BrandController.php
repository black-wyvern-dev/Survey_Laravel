<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Brands;
use  Auth;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brands::where('owner_id', '=', Auth::user()->id)->get();
        return view('user.brand.index', compact('brands'));
    }
    
    public function save(Request $request)
    {
        $file = $request->file('file');
        if ($file) {
            
            $extension = $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName() .'-'. time() . '.' . $extension;

            $path = $file->storeAs(
                 'public/brands', $filename
            );

            if ($path) {
                $upload = Brands::create([
                    'url' => 'brands/' . $filename,
                    'owner_id' => Auth::user()->id,
                ]);

                return response()->json([
                    "status" => "success",
                    "upload_id" => $upload->id,
                    'url' => asset('storage/gallery/' . $filename),
                    "name" => $filename,
                ], 200);

            } else {

                return response()->json([
                    "status" => "error"
                ], 400);

            }
        } else {
            return response()->json('error: upload file not found.', 400);
        }
    }

    /**
     * Update the branch.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function delete(Request $request)
    {
        $file_name = $request->file_name;
        $path = 'brands/'. $file_name;

        Brands::where('url', $path)->first()->delete();
        
        $file = 'public/' . $path;
        if (Storage::exists($file)) {
            Storage::delete($file);
        }
        
        echo 'success';
    }
}
