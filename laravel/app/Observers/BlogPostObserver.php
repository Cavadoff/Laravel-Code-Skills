<?php

namespace App\Observers;

use App\Models\BlogPost;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BlogPostObserver
{
    /**
     * Handle the BlogPost "created" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function created(BlogPost $blogPost)
    {
        //
    }


      /**
     * Handle the BlogPost "creating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function creating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
        $this->setHtml($blogPost);
        $this->setUser($blogPost);
    }



    
     /**
     * Handle the BlogPost "updating" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function updating(BlogPost $blogPost)
    {
        $this->setPublishedAt($blogPost);
        $this->setSlug($blogPost);
    }


    protected function setPublishedAt(BlogPost $blogPost){
      
        if(empty($item->published_at) && $blogPost->is_published){
            $blogPost->published_at= Carbon::now();
        }
    }

    
    protected function setSlug(BlogPost $blogPost){
        if(empty($blogPost->slug)){
            $blogPost->slug=Str::slug($blogPost->title);
        }
    }

/**
 * @param BlogPost $blogPost
 */
    protected function setHtml(BlogPost $blogPost) {

        if($blogPost->isDirty('content_raw')){
            $blogPost->content_html=$blogPost->content_raw;        
        }


    }


    protected function setUser(BlogPost $blogPost){
        $blogPost->user_id = auth()->id() ?? BlogPost:: UNKOWN_USER;
    }

    


    /**
     * Handle the BlogPost "updated" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */

    


    public function updated(BlogPost $blogPost)
    {
        //
    }


    /**
     * Handle the BlogPost "deleting" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleting(BlogPost $blogPost)
    {
        
    }


    /**
     * Handle the BlogPost "deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function deleted(BlogPost $blogPost)
    {
        //dd(__METHOD__, $blogPost);
    }

    /**
     * Handle the BlogPost "restored" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function restored(BlogPost $blogPost)
    {
        //
    }

    /**
     * Handle the BlogPost "force deleted" event.
     *
     * @param  \App\Models\BlogPost  $blogPost
     * @return void
     */
    public function forceDeleted(BlogPost $blogPost)
    {
        //
    }
}
