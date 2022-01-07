@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        {{-- @if (Session::has('categorySuccess'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('categorySuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif --}}

        <div class="row">
          <div class="col-12 mt-3">
            {{ $contact->links() }}

            <div class="card">
              <div class="card-header">
                {{-- <h3 class="card-title">
                  <a href="" class="btn btn-sm btn-outline-dark">Add Category</a>
                </h3> --}}
                <span class="fs-5 ms-5">Total - {{ $contact->total() }}</span>

                <div class="card-tools">
                  <form action="{{ route('admin#contactSearch') }}" method="get">
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
                      <th>Message</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($contact->total() == 0)
                      <tr class="text-danger">
                        <td class="text-muted" colspan="4">
                          There is no data.
                        </td>
                      </tr>
                    @else
                      @foreach ($contact as $item)
                        <tr>
                          <td>{{ $item->contact_id }}</td>
                          <td>{{ $item->name }}</td>
                          <td>
                            {{ $item->email }}
                          </td>
                          <td>
                            {{ $item->message }}
                          </td>
                          {{-- <td>
                          <a href="{{ route('admin#editCategory', $item->category_id) }}"
                            class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></a>
                          <a href="{{ route('admin#deleteCategory', $item->category_id) }}"
                            class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i></a>
                        </td> --}}
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
