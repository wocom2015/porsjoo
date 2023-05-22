<?php

namespace App\Http\Controllers;

use App\Models\Configuration;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ConfigurationController extends Controller
{
    public function index()
    {
        $title = __("p.system_configurations");
        $configs = [];
        foreach(Configuration::all() as $c){
            $configs[$c['item']] = $c['value'];
        }
        return view('admin.configurations.index' , compact("title" , "configs"));
    }


    public function update(Request $request){

        $configs = $request->all();
        $path = storage_path() . '/app/public/configurations/';
        if($file = $request->file("system_logo")){
            $ext = $file->extension();
            $name = Str::random(10);

            $width = Image::make($file)->width();
            $height = Image::make($file)->height();
            $ratio = round($width / $height, 2);

            $file->move( $path, $name.'.'.$ext);
            Image::make($path . '/' . $name.'.'.$ext)->resize(150, 150 / $ratio)->save($path . '/' . $name . '.' . $ext);



            unset($configs['system_logo'],$configs['_token']);
            $configs['system_logo'] = $name.'.'.$ext;
        }
        else{
            $configs['system_logo'] = Configuration::where("item" , "system_logo")->pluck("value")->first();
        }

        foreach ($configs as $item => $value){
            //check for existence
            if(Configuration::where("item" , $item)->exists())
                Configuration::where("item" , $item)->update(["value" => $value]);
            else
                Configuration::create([
                    'item' => $item,
                    'value' => $value
                ]);
        }
        return back()->with('success',__("messages.configuration_updated_successfully"));
    }
}
