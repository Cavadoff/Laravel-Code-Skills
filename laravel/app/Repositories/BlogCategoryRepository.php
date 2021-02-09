<?php

namespace App\Repositories;

use App\Models\BlogCategory as Model;
use Illuminate\Database\Eloquent\Collection;

    
/** 
 * Class  BlogCategoryRepository
 * 
 * @package App\Repositories

*/
class BlogCategoryRepository extends CoreRepository
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
      * Polucit model dla redaktirovanii  adminke
      *
      * @param int $id;
      *
      * @return Model
      */

      public function getEdit($id)
      {
        return $this->startConditions()->find($id);
      }

        /**
      * Polucit spisok kateqorii dla vivoda viplivayuwiy spisok
      *
      * @param int $id;
      *
      * @return Model
      */

      public function getForComboBox()
      {
       
        $columns= implode(', ',[
            'id',
            'CONCAT(id, ". ", title) AS title',
            ]);
            
           /*  $result[]=$this->startConditions()->all();
            $result[]=$this
            ->startConditions()
            ->select('blog_categories.*',\DB::raw('CONCAT(id, ", ", title) AS title')) 
            ->toBase()
            ->get();
            */

            $result = $this
            ->startConditions()
            ->selectRaw($columns) 
            ->toBase()
            ->get();

            return $result;

      }

        /**
      * Polucit kateqorii dila vivoda paginator
      *
      * @param int|null $perPage;
      *
      * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
      */

      public function getAllWithPaginate($perPage=null){

          $columns = ['id','title', 'parent_id'];
          $result = $this
          ->startConditions()
          ->select($columns)
          ->with([
            'parentCategory' => function($query){
              $query->select(['id', 'title']);
            }
          ])
          ->paginate($perPage);

          return $result;

      }


}
