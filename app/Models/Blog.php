<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $guarded = [];
    //relation between models
    public function category(){
        return $this->belongsTo(Category::class,'blog_category_id','id');
    }
}
