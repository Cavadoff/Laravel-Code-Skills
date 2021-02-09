<?php

namespace App\Repositories;

use App\Models\BlogPost as Model;
use Illuminate\Database\Eloquent\Collection;

    
/** 
 * Class  BlogCategoryRepository
 * 
 * @package App\Repositories

*/
class BlogPostRepository extends CoreRepository
{
    /**
     * @return string
     * 
     */

     protected function getModelClass()
     {
         return Model::class;
     }

   /**
      * Polucit posti dila vivoda paginator
      *
      * 
      *
      * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
      */

      public function getAllWithPaginate(){


        $columns = [
        'id',
        'category_id',
        'user_id',
         'title',
         'slug',
         'is_published',
         'published_at',
        ];


        $result = $this
        ->startConditions()
        ->select($columns)
        ->orderBy('id', 'DESC')
        ->with([
            'category'=> function ($query){
                $query->select(['id','title']);
            },
            'user'=> function ($query){
                $query->select(['id','name']);
            },
        ])
        ->paginate(25);

        return $result;

    }

    public function getEdit($id)
      {
        return $this->startConditions()->find($id);
      }








}
