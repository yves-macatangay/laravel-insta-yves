<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = "category_post"; //this is the table name
    public $timestamps = false; //do not save timestamps
    protected $fillable = ['category_id', 'post_id'];

    //category_post belongs to a category
    public function category(){
        return $this->belongsTo(Category::class);
    }
}
