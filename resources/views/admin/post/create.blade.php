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
                            <li class="breadcrumb-item active"> Create Post</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create Post</h3>
                        <ol class=" float-sm-right">
                            <a href="{{route('post.index')}}" class="btn btn-block btn-info btn-sm">All Post</a>

                        </ol>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <!-- Title -->
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" :value="old('title')" id="title" required>
                                @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                </span>
                                @enderror
                            </div>


                            <!-- Category & SubCategory -->
                            <div class="form-group ">
                                <label for="category_name" class="col-sm-2 col-form-label">Category</label>
                                <select name="subcategory_id" class="form-control">
                                    <option disabled selected>Chooce Category</option>
                                    @foreach ($categories as $category )
                                    <!-- Category er under e SubCategory ber kore  -->
                                    @php
                                    $subCategory = DB::table('subcategorieds')->where('category_id', $category->id)->get();
                                    @endphp
                                    <option disabled class="text-info" disabled>{{$category->category_name}}</option>

                                    @foreach ($subCategory as $sub )
                                    <option value="{{$sub -> id}}">------{{$sub->subcategory_name}}</option>
                                    @endforeach

                                    @endforeach
                                </select>
                            </div>

                            <!-- Description -->
                            <div class="form-group ">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>

                                <textarea name="description" class="form-control summernote @error('description') is-invalid @enderror" :value="old('description') " id="description" required>
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

                                <input type="date" name="post_date" class="form-control @error('post_date') is-invalid @enderror" :value="old('post_date')" id="post_date">

                            </div>


                            <!-- Tags -->
                            <div class="form-group  ">
                                <label for="tags" class="col-sm-2 col-form-label">Tags</label>

                                <input type="text" name="tags" class="form-control @error('tags') is-invalid @enderror" :value="old('tags')" id="tags">
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
                                </div>
                            </div>


                            <!-- Checkbox -->
                            <div class="form-check col-sm-12">
                                <label class="form-check-label" for="status"> </label>

                                <input type="checkbox" class="form-check-input" id="status" name="status" value="1">
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