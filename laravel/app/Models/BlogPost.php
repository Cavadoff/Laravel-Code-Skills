<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    public function category(){
        return $this->belongsTo(BlogCategory::class);
    }


    public function user(){
        return $this->belongsTo(User::class);
    }

    const UNKOWN_USER=1;
   

    protected $fillable =[
        'title',
        'slug',
        'content_raw',
        'excerpt',
        'category_id',
        'is_published',

    ];

}
