<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Post</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Post Table</li>
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
                                <h3 class="card-title">All Post</h3>
                                <ol class=" float-sm-right">
                                    <a href="{{route('post.create')}}" class="btn btn-block btn-secondary btn-xs">Create Post</a>

                                </ol>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th> Sl</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Published</th>
                                            <th>Status</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($post as $key=>$row)
                                        <tr>
                                            <th>{{++$key}}</th>
                                            <!-- These 3 <td> will use when I will join these 3 tables in the controller. But now I'm joining those tables in the model. -->

                                            <!-- <td>{{$row->category_name}}</td>
                                            <td>{{$row->subcategory_name}}</td>
                                            <td>{{$row->name}}</td> -->

                                            <td>{{$row->category->category_name}}</td>
                                            <td>{{$row->subcategory->subcategory_name}}</td>
                                            <td>{{$row->user->name}}</td>
                                            <td>{{$row->title}}</td>
                                            <td>{{date('d M, Y', strtotime($row->post_date))}}</td>
                                            <td>
                                                @if($row->status===1)
                                                <span class="badge badge-success">Active</span>
                                                @else
                                                <span class="badge badge-danger">Inactive</span>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{route('post.edit', $row->id)}}" class="btn btn-info">Edit</a>
                                                <a href="{{route('post.delete', $row->id)}}" class="btn btn-danger delete">Delete</a>
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