<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Traits\UploadAble;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Http\Controllers\BaseController;

class SettingController extends BaseController
{
    use UploadAble;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->setPageTitle('Settings', 'Manage Settings');

        return view('admin.settings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        if($request->has('site_logo') && ($request->file('site_logo')) instanceof UploadedFile){
            if(config('settings.site_logo') !=null){
                $this->deleteOne(config('settings.site_logo'));
            }

            $logo = $this->uploadOne($request->file('site_logo'), 'img');


            Setting::set('site_logo', $logo);
        }elseif ($request->has('site_favicon') && ($request->file('site_favicon')) instanceof UploadedFile) {
            if(config('settings.stie_favicon')!=null){
                $this->deleteOne(config('settings.site_favicon'));
            }

            $favicon = $this->uploadOne($request->file('site_favicon'), 'img');
            Setting::set('site_favicon', $favicon);
        }else{
            $keys = $request->except('_token');
            foreach($keys as $key => $value){
                Setting::set($key, $value);
            }
        }
        return $this->responseRedirectBack('Settings updated successfully', 'success');
    }

}
