@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('deleteSuccess'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('deleteSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif

        <div class="row">
          <div class="col-12 mt-3">
            {{ $admin->links() }}

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#userList') }}" class="btn btn-sm btn-outline-dark">User List</a>
                  <a href="{{ route('admin#adminList') }}" class="btn btn-sm btn-dark">Admin List</a>
                </h3>

                <div class="card-tools">
                  <form action="{{ route('admin#adminSearch') }}" method="get">
                    {{-- @csrf --}}
                    <div class="input-group input-group-sm" style="width: 150px;">
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
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($admin->total() == 0)
                      <tr class="text-danger">
                        <td class="text-muted" colspan="6">
                          There is no data.
                        </td>
                      </tr>
                    @else
                      @foreach ($admin as $item)
                        <tr>
                          <td>{{ $item->id }}</td>
                          <td>{{ $item->name }}</td>
                          <td>{{ $item->email }}</td>
                          <td>{{ $item->phone }}</td>
                          <td>{{ $item->address }}</td>

                          <td>
                            <a href="{{ route('admin#adminDelete', $item->id) }}"
                              class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i>
                            </a>
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
