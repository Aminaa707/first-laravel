<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>SubCategory</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">SubCategory Table</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All SubCategory</h3>
                                <ol class=" float-sm-right">
                                    <a href="{{route('subcategory.create')}}" class="btn btn-block btn-secondary btn-xs">Create SubCategory</a>

                                </ol>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Sl</th>
                                            <th>Category Name</th>
                                            <th>Subcategory Name</th>
                                            <th>Subcategory Slug</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($subCategory as $key=>$row)
                                        <tr>
                                            <th>{{++$key}}</th>
                                            <td>{{$row->category->category_name}}</td>
                                            <td>{{$row->subcategory_name}}</td>
                                            <td>{{$row->subcategory_slug}}</td>
                                            <td>
                                                <a href="{{route('subcategory.edit', $row->id)}}" class="btn btn-info">Edit</a>
                                                <a href="{{route('subcategory.delete', $row->id)}}" class="btn btn-danger delete">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>

</x-app-layout>