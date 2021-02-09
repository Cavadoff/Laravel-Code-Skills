<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\BlogPost;

class DiggingDeeperController extends Controller
{
    public function collections(){
        $result= [];

        $eloquentCollection= BlogPost::withTrashed()->get();
        //dd(__METHOD__, $eloquentCollection, $eloquentCollection->toArray());

        $collection=collect($eloquentCollection->toArray());

        //dd(
          //  get_class($eloquentCollection),
            //get_class($collection),
            //$collection
        //);

        //$result['first']=$collection->first();
        //$result['last']=$collection->last();
        //dd($result);

        $result['where']['data']=$collection
        ->where('category_id', 10)
        ->values()
        ->keyBy('id');

        //dd($result);

       //$result['where']['count'] = $result['where']['data']->count();
        //$result['where']['isEmpty'] = $result['where']['data']->isEmpty();
        //$result['where']['isNotEmpty'] = $result['where']['data']->isNotEmpty();

        /**
         * esli nujen postavit usloviyu, to etotot variant lucer
         * if($result['where']['data']->isNotEmpty){
         * ......
         * }
         */

       //$result['where_first']=$collection
         //->firstWhere('created_at', '<','2020-11-10 23:12:22');
         
         //$result['map']['all']=$collection->map(function($item){
             
             //$newItem= new \stdClass();
             //$newItem->item_id=$item['id'];
             //$newItem->item_name=$item['title'];
             //$newItem->item_exists=is_null($item['deleted_at']);

             //return $newItem;
         //});


        // $result['map']['not_exists']=$result['map']['all']->where('not_exists','=', true);
         
        //METOD TRANSFORM

        $collection->transform(function($item){
            $newItem=new \stdClass();
            $newItem->item_id=$item['id'];
            $newItem->item_name=$item['title'];
            $newItem->item_exists=is_null($item['deleted_at']);
            $newItem->created_at=Carbon::parse($item['created_at']);

            return $newItem;
        });
        
      //  $newItem= new \stdClass();
        //$newItem->id=999;

        //$newItem2= new \stdClass();
        //$newItem2->id=888;

        //dd($newItem,$newItem2);

        //FILTRASIYA ZAMENA orWhere

        $collection->filter(function($item){
            $byDay=$item->created_at->isFriday();
            $byDate=$item->created_at-> day==8;

            $result= $byDay && $byDate;
            dd($result);
            return $result;
            
        });

    }
}
