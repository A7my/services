<?php

namespace App\Http\Controllers\Web\Service_Provider;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Service_Provider\ProfileRepositiry;


class ProfileController extends Controller
{
    protected $settings;
    public function __construct(ProfileRepositiry $settings){
        $this->settings = $settings;
    }
    public function settings(Request $request){
        $data = $request->all();
        $this->settings->settings($data);
        return redirect()->back()->with('infoupdated' , 'you have updated your info successfully');
    }
}
