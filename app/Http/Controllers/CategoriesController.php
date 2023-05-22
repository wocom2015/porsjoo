<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\File;
use Intervention\Image\Facades\Image;
use App\Http\Resources\Category as CatResource;


class CategoriesController extends Controller
{


    public function findLevel($category_Id)
    {
        $parent = $category_Id;

        if($parent==1){
            return 0;
        }
        $level = 0;
        while ($parent != 0) {
            $category = Category::find($parent);
            $parent = $category->parent_id;
            $level++;
        }
        return $level-1;
    }


    function getA($parent)
    {
        $info = Category::where("id" , $parent)->select("id" , "name")->first();
        $output = [];
        if($info){
            $info->level = $this->findLevel($info->id);
             $output = $info;
            $children = Category::where("parent_id" , $parent)->get();
            if ($children->isNotEmpty()) {
                foreach ($children as $child) {
                    $CH = self::getA($child->id);
                    if (!empty($CH)) {
                        foreach ($CH as $C){
                            $output[] = $C;
                        }
                    }
                }
            }
        }

        return $output;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = __("p.categories");
        $children = $this->children();
        $categories = $this->getA(1);
        $parent_name = 'parent_id';
        return view("admin.categories.index" , compact("title" , "children" , "categories" , "parent_name"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request ,[
            'name' => 'required' ,
        ]);


        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'slug' => Str::slug($request->name , '-' , null),
            'parent_id' => $request->parent_id,
        ]);
        return reply('success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'parent_id' => 'required',
            'picture' => [
                'nullable',
                File::types(['png', 'jpg' , 'jpeg'])
                    ->max(5 * 1024),
            ]
        ]);

        $category = Category::find($request->id);

        $category->name = $validated['name'];
        $category->parent_id = $validated['parent_id'];
        $category->description = $request->description;

        if($request->has("picture")){
            $this->uploadPicture($category, $request);
        }
        $category->update();

        return reply('success');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if(!empty($category->children->all())){
            return back()->with("error" , __("messages.the_cat_for_delete_has_child"));
        }
        if(Category::where("id" , $id)->delete())
            return back();
    }

    public static function saved($callback)
    {
        // TODO: Implement saved() method.
    }

    public static function deleted($callback)
    {
        // TODO: Implement deleted() method.
    }

    public function morphToMany($related, $name, $table = null, $foreignPivotKey = null, $relatedPivotKey = null, $parentKey = null, $relatedKey = null, $inverse = false)
    {
        // TODO: Implement morphToMany() method.
    }

    public function item(Request $request){
        return Category::select("id" , "name","description" , "parent_id")->findOrFail($request->id);
    }

    public function subList(Request $request){
        $category = Category::findOrFail($request->id);
        return CatResource::Collection($category->children);
    }

    /**
     * @param $category
     * @param Request $request
     * @return void
     */
    public function uploadPicture($category, Request $request): void
    {
        $currentPicture = $category->picture;
        $currentExt = $category->ext;
        $name = Str::random(20);
        $file = $request->file('picture');
        $extension = $file->getClientOriginalExtension();
        $fileName = $name . '.' . $extension;
        $path = storage_path() . '/app/public/categories/' . $category->id;

        $width = Image::make($file)->width();
        $height = Image::make($file)->height();
        $ratio = round($width / $height, 2);

        $request->file('picture')->move($path, $fileName);
        $sizes = [30, 100, 250];
        foreach ($sizes as $size) {
            Image::make($path . '/' . $fileName)->resize($size, $size / $ratio)->save($path . '/' . $name . '-' . $size . '.' . $extension);
        }
        unlink($path . '/' . $fileName);
        $category->picture = $name;
        $category->ext = $extension;


        if ($currentPicture !== '') {
            foreach ($sizes as $size) {
                $file = $path . '/' . $currentPicture . '-' . $size . '.' . $currentExt;
                if (file_exists($file))
                    unlink($file);
            }
        }
    }

    public function children($parent_id = 1)
    {
        return Category::where("parent_id", $parent_id)->get();
    }
}
