<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;

class CategoriesController extends Controller
{
    private $category;
    private $post;

    public function __construct(Category $category, Post $post){
        $this->category = $category;
        $this->post = $post;
    }

    public function index(){
        $all_categories = $this->category->orderBy('name')->paginate(10);

        $all_posts = $this->post->all();
        $count = 0;
        foreach($all_posts as $post){
            if($post->categoryPosts->count() == 0){
                $count++; //add 1 to count
            }
        }

        return view('admin.categories.index')->with('all_categories', $all_categories)
                                            ->with('uncategorized_count', $count);
    }

    public function store(Request $request){

        $request->validate([
            'name' => 'required|max:50|unique:categories,name'
        ]);

        $this->category->name = $request->name;
        $this->category->save();

        return redirect()->back();
    }

    public function destroy($id){
        $this->category->destroy($id);

        return redirect()->back();
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|max:50|unique:categories,name,'.$id
            //unique:categories,name,5
        ]);

        $categ = $this->category->findOrFail($id);
        $categ->name = $request->name;
        $categ->save();

        return redirect()->back();
    }
}
