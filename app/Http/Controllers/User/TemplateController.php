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

use App\Models\Template;

class TemplateController extends Controller
{

    public function list()
    {
        $templates = Template::where('owner_id', '=', Auth::user()->id)->orderByDesc('created_at')->get();
        return view('user.template.list', compact('templates'));
    }
    
    public function create(Request $request)
    {
        return view('user.template.create');
    }

    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required',   
            'description' => 'required'
        ]);

        $template = Template::create([
            'name' => $request->name,
            'description' => $request->description,
            'header_left' => $request->header_left,
            'header_center' => $request->header_center,
            'header_right' => $request->header_right,
            'footer_left' => $request->footer_left,
            'footer_center' => $request->footer_center,
            'footer_right' => $request->footer_right,
            'status' => 'draft',
            'owner_id' => Auth::user()->id,
        ]);
        
        if($template) {
            return redirect()->route('user.template.list');
        }
        else {
            return redirect()->back();
        }
    }   

    public function edit(Request $request) {
        $template_id = $request->template_id;
        $template = Template::find($template_id);
        if($template->status == 'ready') {
            Session::put("message","This template is running, you couldn't edit this template!");
            return redirect()->route('user.template.list');
        }
        else {
            return view('user.template.edit', compact('template'));
        }
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',   
            'description' => 'required',
            'status' => 'draft'
        ]);

        $template = Template::updateorCreate([
            'id' => $request->template_id
        ],[
            'name' => $request->name,
            'description' => $request->description,
            'header_left' => $request->header_left,
            'header_center' => $request->header_center,
            'header_right' => $request->header_right,
            'footer_left' => $request->footer_left,
            'footer_center' => $request->footer_center,
            'footer_right' => $request->footer_right,
            'status' => 'draft',
            'owner_id' => Auth::user()->id,
        ]);

        if($template) {
            return redirect()->route('user.template.list');
        }
        else {
            return redirect()->back();
        }
    }

    public function delete(Request $request) {
        $template_id = $request->template_id;
        if($template = Template::find($template_id)) {
            if($template->status == 'ready') {
                echo 'running';
            }
            else {
                $template->delete();
                echo 'success';
            }
        }
    }

    /**
     * Set the status of Template
     * 
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request)
    {
        $template_id = $request->template_id;
        if($exist = Template::where('status', 'ready')->first()) {
            $exist->status = 'draft';
            $exist->save();
        }

        $template = Template::find($template_id);
        $template->status = 'ready';
        $template->save();

        echo 'success';
    }
}
