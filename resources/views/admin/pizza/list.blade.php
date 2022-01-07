@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        @if (Session::has('createSuccess'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('createSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('deleteSuccess'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('deleteSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        @if (Session::has('updateSuccess'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('updateSuccess') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        @endif
        <div class="row">
          <div class="col-12 mt-4">
            {{ $pizza->links() }}
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <a href="{{ route('admin#addPizza') }}" class="btn btn-sm bg-dark mt-1">
                    <i class="fas fa-plus"></i>
                  </a>
                </h3>
                <span class="fs-5 ms-4">Total - {{ $pizza->total() }}</span>

                <div class="card-tools d-flex">
                  <div class="mt-1 me-2">
                    <a href="{{ route('admin#pizzaDownload') }}" class="btn btn-sm btn-success">CSV Download</a>
                  </div>
                  <form action="{{ route('admin#searchPizza') }}" method="get">
                    {{-- @csrf --}}
                    <div class="input-group input-group-sm mt-1" style="width: 150px;">

                      <input type="text" name="pizzaSearch" class="form-control float-right" placeholder="Search">
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
                      <th>Pizza Name</th>
                      <th>Image</th>
                      <th>Price</th>
                      <th>Publish Status</th>
                      <th>Buy 1 Get 1 Status</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if ($pizza->total() == 0)
                      <tr class="text-danger">
                        <td class="text-muted" colspan="7">
                          There is no data.
                        </td>
                      </tr>
                    @else
                      @foreach ($pizza as $item)
                        <tr>
                          <td>{{ $item->pizza_id }}</td>
                          <td>{{ $item->pizza_name }}</td>
                          <td>
                            <img src="{{ asset('uploads/' . $item->image) }}" class="img-thumbnail" width="100px">
                          </td>
                          <td>{{ $item->price }}</td>
                          <td>
                            @if ($item->publish_status == '1')
                              Publish
                            @elseif($item->publish_status == '0')
                              Unpublish
                            @endif
                          </td>
                          <td>
                            @if ($item->buy_one_get_one_status == '1')
                              Yes
                            @elseif($item->buy_one_get_one_status == '0')
                              No
                            @endif
                          </td>
                          <td>
                            <a href="{{ route('admin#editPizza', $item->pizza_id) }}"
                              class="btn btn-sm btn-secondary text-white"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('admin#deletePizza', $item->pizza_id) }}"
                              class="btn btn-sm bg-danger text-white"><i class="fas fa-trash-alt"></i>
                            </a>
                            <a href="{{ route('admin#pizzaInfo', $item->pizza_id) }}"
                              class="btn btn-sm btn-info text-black"><i class="fas fa-eye"></i></a>
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
