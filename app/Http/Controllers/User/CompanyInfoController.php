<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Auth;

use App\Models\CompanyInfo;
use DateTime;

class CompanyInfoController extends Controller
{

    public function list()
    {
        $infors = CompanyInfo::where('category_id', '!=', '0')->where('owner_id', '=', Auth::user()->id)->get();
        return view('user.companyInfo.list', compact('infors'));
    }   

    public function update(Request $request) {
        
        $info_id = $request->company_info_id;

        $companyInfo = CompanyInfo::find($info_id);

        $companyInfo->url = $request->url;
        $companyInfo->save();

        return redirect()->back();
    }

    public function logo(Request $request) {
        $logo = CompanyInfo::where('category_id', '=', '0')->where('owner_id', '=', Auth::user()->id)->first();
        return view('user.companyInfo.logo', compact('logo'));
    }

    public function updateLogo(Request $request) {
        $logo = CompanyInfo::where('category_id', '=', '0')->where('owner_id', '=', Auth::user()->id)->first();
        if($request->hasFile('url')) {
            if($logo->url != '') {
                $file = 'public/' . $logo->url;
                if(Storage::exists($file)) {
                    if($logo->url != 'logo/company_logo.png') {
                        Storage::delete($file);
                    }
                }
            }
            
            $image = $request->file('url');
            
            $date = new DateTime();
            $new_logo_name = $date->getTimestamp();
            print_r($new_logo_name);
            
            
            $file_name = $new_logo_name.'.'.$image->guessExtension();
            print_r($file_name);
            $path = $image->storeAs(
                'public/logo', $file_name
            );
            
            $url = 'logo/'.$file_name;
            $logo->url = $url;
            $logo->save();
        }
        return back();
    }
}
