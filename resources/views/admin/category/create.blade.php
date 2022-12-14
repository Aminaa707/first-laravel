<x-app-layout>

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active"> Create Category</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Create Category</h3>
                        <ol class=" float-sm-right">
                            <a href="{{route('category.index')}}" class="btn btn-block btn-info btn-sm">All Category</a>

                        </ol>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" method="post" action="{{route('category.store')}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="category_name" class="col-sm-2 col-form-label">Category Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_name" class="form-control @error('category_name') is-invalid @enderror" :value="old('category_name')" id="category_name" required autofocus>
                                    @error('category_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
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