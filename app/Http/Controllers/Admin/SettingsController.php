<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\StoreSettingRequest;
use Session;

class SettingsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index()
    {
        
    }

    public function create()
    {
        abort_if(Gate::denies('setting-create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $settings = Setting::first();   
        return view('admin.settings.create',compact('settings'));
    }

    public function store(StoreSettingRequest $request)
    {
        // dd($request->all());
            if($request->hasFile('logo') && $request->file('logo')->isValid()){
                $file = $request->file('logo');
                $logo= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/logo',$logo);
            } else {
                $logo = null;
            }
            if($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()){
                $file = $request->file('footer_logo');
                $footer_logo= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/footer_logo',$footer_logo);
            } else {
                $footer_logo = null;
            }
            if($request->hasFile('favicon') && $request->file('favicon')->isValid()){
                $file = $request->file('favicon');
                $favicon= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/favicon',$favicon);
            } else {
                $favicon = null;
            }

            $data=[
                'title' => $request->title,
                'logo'  =>  $logo,
                'favicon'   =>  $favicon,
                'copyright' =>  $request->copyright,
                'footer_logo'   =>  $footer_logo,
                'theme_color'   => $request->theme_color,
                'description'   => $request->description
            ];
            
            $setting = Setting::create($data);
       
        Session::flash('flash_success', 'Settings created successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();

    }

    public function update(StoreSettingRequest $request, Setting $setting)
    {
        // dd($request->all());
            if($request->hasFile('logo') && $request->file('logo')->isValid()){
                $file = $request->file('logo');
                $logo= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/logo',$logo);
            }
            if($request->hasFile('footer_logo') && $request->file('footer_logo')->isValid()){
                $file = $request->file('footer_logo');
                $footer_logo= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/footer_logo',$footer_logo);
            }
            if($request->hasFile('favicon') && $request->file('favicon')->isValid()){
                $file = $request->file('favicon');
                $favicon= uniqid().'_'.$file->getClientOriginalName();
                $file->storeAs('public/uploads/favicon',$favicon);
            }
            $data=[
                'title' => $request->title,
                'logo'  =>  (isset($logo))?$logo:$setting->logo,
                'favicon'   =>  (isset($favicon))?$favicon:$setting->favicon,
                'copyright' =>  $request->copyright,
                'footer_logo'   =>  (isset($footer_logo))?$footer_logo:$setting->footer_logo,
                'theme_color'   => $request->theme_color,
                'description'   => $request->description
            ];
            // dd($data);
            $setting->update($data);
       
        Session::flash('flash_success', 'Settings updated successfully!.');
        Session::flash('flash_type', 'alert-success');
        return redirect()->back();

    }
}
