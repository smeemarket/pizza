@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('categorySuccess'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('categorySuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('categoryDelete'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('categoryDelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="row">
          <div class="col-12 mt-3">
            {{ $category->links() }}

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#addCategory') }}" class="btn btn-sm btn-outline-dark">Add Category</a>
                </h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Category Name</th>
                      <th>Pizza Count</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($category as $item)
                      <tr>
                        <td>{{ $item->category_id }}</td>
                        <td>{{ $item->category_name }}</td>
                        <td></td>
                        <td>
                          <button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button>
                          <a href="{{ route('admin#deleteCategory', $item->category_id) }}"
                            class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
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
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
