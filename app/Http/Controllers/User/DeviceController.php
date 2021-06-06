<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Webpatser\Uuid\Uuid;
use Auth;

use App\Models\Branchs;
use App\Models\Device;

class DeviceController extends Controller
{

    public function list()
    {
        $branches = Branchs::getArrayByOwner(Auth::user()->id);
        $devices = Device::where('owner_id', '=', Auth::user()->id)->orderByDesc('created_at')->get();

        return view('user.device.list', compact('devices'));
    }
    
    public function create(Request $request)
    {
        $branches = Branchs::getAllByOwner(Auth::user()->id);
        return view('user.device.create', compact('branches'));
    }

    public function save(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'mac_num' => 'required',
            'branch_id' => 'required',
        ]);

        $device = Device::create([
            'name' => $request->name,
            'mac_num' => $request->mac_num,
            'branch_id' => $request->branch_id,
            'owner_id' => Auth::user()->id,
        ]);

        if($device) {
            return redirect()->route('user.device.list');
        }
        else {
            return redirect()->back();
        }
    }   

    public function edit(Request $request) {
        $device_id = $request->device_id;
        $device = Device::find($device_id);

        $branches = Branchs::getAllByOwner(Auth::user()->id);
        return view('user.device.edit', compact('device', 'branches'));
    }

    public function update(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'mac_num' => 'required',
            'branch_id' => 'required'
        ]);

        $device_id = $request->device_id;

        $device = Device::updateOrCreate([
            'id' => $device_id
        ], [
            'name' => $request->name,
            'mac_num' => $request->mac_num,
            'branch_id' => $request->branch_id,
            'owner_id' => Auth::user()->id,
        ]);

        if($device) {
            return redirect()->route('user.device.list');
        }
        else {
            return redirect()->back();
        }
    }

    public function delete(Request $request) {
        $device_id = $request->device_id;
        if($device = Device::find($device_id)) {
            Device::where('id', $device_id)->delete();
            echo 'success';
        }
    }
}
