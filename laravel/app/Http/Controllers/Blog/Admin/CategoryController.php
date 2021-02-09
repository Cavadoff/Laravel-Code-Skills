<?php

namespace App\Http\Controllers\Blog\Admin;
use App\Models\BlogCategory;
//use App\Http\Controllers\Controller;
use App\Http\Requests\BlogCategoryUpdateRequest;
use App\Http\Requests\BlogCategoryCreateRequest;
use App\Repositories\BlogCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends BaseController
{
    /**
     * @var BlogCategoryRepository
     */
    private $blogCategoryRepository;

    public function __construct(){
        parent::__construct();
        $this->blogCategoryRepository = app(BlogCategoryRepository::class);
    
    }
        



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$paginator=BlogCategory::paginate(15);

        $paginator=$this->blogCategoryRepository->getAllWithPaginate(15);

        return view('blog.admin.categories.index',compact('paginator'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item=new BlogCategory();
        $categoryList=$this->blogCategoryRepository->getForComboBox();
        //$categoryList=BlogCategory::all();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogCategoryCreateRequest $request)
    {
       $data=$request->input();
       /*if(empty($data['slug'])){
           $data['slug']=Str::slug($data['title']);
       }*/

       $item=(new BlogCategory())->create($data);
       
       if($item){
           return redirect()
           ->route('blog.admin.categories.edit',[$item->id])
           ->with(['success'=>'Saved succesfuly']);
       }
       else{
        return back()
        ->withErrors(['msg'=>'Save Error'])
        ->withInput();
       }
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @param BlogCategoryRepository $categoryRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       // $item=BlogCategory::getEdit($id);
        //$categoryList=BlogCategory::all();
        $item=$this->blogCategoryRepository->getEdit($id);
        if(empty($item)){
            abort(404);
        }
        $categoryList=$this->blogCategoryRepository->getForComboBox();

        return view('blog.admin.categories.edit',
        compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogCategoryUpdateRequest $request, $id)
    {
        /*$rules = [
            'title' => 'required|min:5|max:200',
            'slug' => 'max:200',
            'description' => 'string|min:3|max:500',
            'parent_id' => 'required|integer|exists:blog_categories,id',

        ];*/
        //$validateData = $this->validate($request, $rules);
        //$validateData = $request->validate($rules);
       // dd($validateData);

       $item=$this->blogCategoryRepository->getEdit($id);
       if(empty($item)){
           return back()
           ->withErrors(['msg' => "Note id=[{$id}] is not defined"])
           ->withInput();
       }
       $data=$request->all();
       /*if(empty($data['slug'])){
        $data['slug']=Str::slug($data['title']);
    }*/
       $result=$item->update($data);

      

       if($result){
           return redirect()
           ->route('blog.admin.categories.edit',$item->id)
           ->with(['success'=>'Saved succesfuly']);
       }
       else{
           return back()
           ->withErrors(['msg'=>'Save Error'])
           ->withInput();
       }
    }

   
}
