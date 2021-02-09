<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;
    
    protected $fillable
    = [
    
        'title',
        'slug',
        'parent_id',
        'description',

    ];

    public function parentCategory(){
        return $this->belongsTo(BlogCategory::class, 'parent_id', 'id');
    }

    const ROOT = 1;

    /**
     * primeri aksesuari (accesor)
     */

    public function getParentTitleAttribute(){
        $title= $this->parentCategory->title
        ?? ($this->isRoot()
        ? 'Main'
        : '???');

        return $title;
    }

    public function isRoot(){
        return $this->id=== BlogCategory:: ROOT;
    }
}
