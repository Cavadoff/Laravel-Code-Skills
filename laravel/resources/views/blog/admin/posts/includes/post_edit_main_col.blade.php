@php
    /** @var \App\Models\BlogPost $item */ 
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header" >
                    @if($item->is_published)
                    Published
                    @else
                    Draft
                    @endif
                </div>
                <div class="card-body">
                    <div class="card-title"></div>
                    <div class="card-subtitle mb-2 text-muted"></div>
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" role="tab" data-toggle="tab" href="#maindata">Main dates</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" role="tab" data-toggle="tab" href="#adddata">Additional</a>
                        </li>
                    </ul>
                    <br>
                    <div class="tab-content">
                        <div class="tab-pane active" id="maindata" role="tabpanel">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" value="{{old('title',$item->title)}}"
                                id="title"
                                class="form-control"
                                minlength="3"
                                required
                                >
                            </div>


                            <div class="form-group">
                                <label for="content_raw">Article</label>
                                <textarea name="content_raw" 
                                id="content_raw" 
                                rows="20"
                                class="form-control">{{old('content_raw', $item->content_raw)}}</textarea>
                            </div>
                        </div>
                            <div class="tab-pane" id="adddata" role="tabpanel">
                                <div class="forn-group">
                                    <label for="category_id">Category</label>
                                    <select name="category_id" id="category_id" class="form-control" placeholder="Choose Category" required>
                                        @foreach ($categoryList as $categoryOption )
                                            <option value="{{$categoryOption->id}}"
                                                @if ($categoryOption->id==$item->category_id) selected @endif>
                                                {{$categoryOption->title}}
                                            </option>    
                                    @endforeach
                                    </select>
                                   </div>

                                   
                                   <div class="form-group">
                                    <label for="slug">Identification</label>
                                    <input type="text" name="slug" value="{{$item->slug}}"
                                    id="slug"
                                    class="form-control"
                                    >
                                </div>

                                
                            <div class="form-group">
                                <label for="excerpt">Excerpt</label>
                                <textarea name="excerpt" 
                                id="excerpt" 
                                rows="5"
                                class="form-control">{{old('excerpt', $item->excerpt)}}</textarea>
                            </div>

                            <div class="form-check">
                                <input type="hidden" 
                                name="is_published" 
                                value="0">

                                <input type="checkbox" 
                                name="is_published"
                                class="form-check-input" 
                                value="1"
                                @if ($item->is_published)
                                    checked="checked"
                                @endif
                                >
                                <label class="form-check-label" for="is_published">Published</label>
                            </div>

                            </div>

                        
                    
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>