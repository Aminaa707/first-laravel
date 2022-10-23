<x-app-layout>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Posts</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"> Edit Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Edit Post</h3>
                        <ol class=" float-sm-right">
                            <a href="{{route('post.index')}}" class="btn btn-block btn-info btn-sm">All Post</a>

                        </ol>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('post.update', $Post->id)}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <!-- Title -->
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{$Post->title}}" id="title" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>


                            <!-- Category & SubCategory -->
                            <div class="form-group ">
                                <label for="category_name" class="col-sm-2 col-form-label">Category</label>
                                <select name="category" class="form-control @error('category') is-invalid @enderror " required>
                                    <option disabled selected>Chooce Category</option>
                                    @foreach ($categories as $category )
                                    <!-- Category er under e SubCategory ber kore  -->
                                    @php
                                    $subCategory = DB::table('subcategorieds')->where('category_id', $category->id)->get();
                                    @endphp
                                    <option disabled class="text-info" disabled>{{$category->category_name}}</option>

                                    @foreach ($subCategory as $sub )
                                    <option value="{{$sub -> id}}" @if($sub -> id === $Post->subcategory_id) selected @endif>------{{$sub->subcategory_name}}</option>
                                    @endforeach

                                    @endforeach
                                </select>
                                @error('category')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group ">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>

                                <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror" id="description" required> {{$Post->description}}
                                </textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror

                            </div>


                            <!-- Post Data -->
                            <div class="form-group  ">
                                <label for="post_date" class="col-sm-2 col-form-label">Post Date</label>

                                <input type="date" name="post_date" class="form-control @error('post_date') is-invalid @enderror" value="{{$Post->post_date}}" id="post_date">

                            </div>


                            <!-- Tags -->
                            <div class="form-group  ">
                                <label for="tags" class="col-sm-2 col-form-label">Tags</label>

                                <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" value="{{$Post->tags}}" id="tags">
                                @error('tags')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>



                            <!-- Images -->
                            <div class="form-group row ">

                                <label for="image" class="col-sm-2 col-form-label"> Choose File </label>

                                <div class="custom-file">
                                    <input type="file" name="image" class="custom-file-input" id="image">
                                    <label class="custom-file-label" for="image">Choose file</label>
                                    <input type="hidden" name="old_image" class="custom-file-input" id="image" value="{{$Post->image}}">

                                </div>

                                <!-- Chosen Img -->
                                <div class="col-12 col-md-9 my-4">
                                    <div class="card-img mx-auto rounded-circle">
                                        <img id="show_img" src="{{(!empty($Post->image)? url($Post->image) : url('public/media/no_images.png') )}}" alt="user image" width="200px">
                                    </div>
                                </div>

                                <!-- Checkbox -->
                                <div class="form-check col-sm-12">
                                    <label class="form-check-label" for="status"> </label>

                                    <input type="checkbox" class="form-check-input" @if($Post->status === 1) checked @endif id="status" name="status" value="1">
                                    <label class="form-check-label" for="status">Publish Now</label>
                                </div>

                            </div>


                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-info">Submit</button>

                            </div>
                            <!-- /.card-footer -->
                    </form>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>