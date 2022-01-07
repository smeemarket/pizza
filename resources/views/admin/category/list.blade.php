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
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('categoryDelete') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('updateSuccess'))
          <div class="alert alert-secondary alert-dismissible fade show" role="alert">
            {{ Session::get('updateSuccess') }}
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
                  <a href="{{ route('admin#addCategory') }}" class="btn btn-sm btn-outline-dark mt-1">Add Category</a>
                </h3>
                <span class="fs-5 ms-4">Total - {{ $category->total() }}</span>

                <div class="card-tools d-flex">
                  <div class="mt-1 me-2">
                    <a href="{{ route('admin#categoryDownload') }}" class="btn btn-sm btn-success">CSV Download</a>
                  </div>
                  <form action="{{ route('admin#searchCategory') }}" method="get">
                    {{-- @csrf --}}
                    <div class="input-group input-group-sm mt-1" style="width: 150px;">
                      <input type="text" name="searchData" class="form-control float-right" placeholder="Search">

                      <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                          <i class="fas fa-search"></i>
                        </button>
                      </div>
                    </div>
                  </form>
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
                    @if ($category->total() == 0)
                      <tr class="text-danger">
                        <td class="text-muted" colspan="7">
                          There is no category.
                        </td>
                      </tr>
                    @else
                      @foreach ($category as $item)
                        <tr>
                          <td>{{ $item->category_id }}</td>
                          <td>{{ $item->category_name }}</td>
                          <td class="text-decoration-none text-black">
                            @if ($item->pizzaCount == 0)
                              {{ $item->pizzaCount }}
                            @else
                              <a href="{{ route('admin#categoryItem', $item->category_id) }}">
                                {{ $item->pizzaCount }}
                              </a>
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('admin#editCategory', $item->category_id) }}"
                              class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin#deleteCategory', $item->category_id) }}"
                              class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                          </td>
                        </tr>
                      @endforeach
                    @endif
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
