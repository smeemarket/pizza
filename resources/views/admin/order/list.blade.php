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
            {{ $order->links() }}

            <div class="card">
              <div class="card-header">
                <span class="fs-5 ms-5">Total - {{ $order->total() }}</span>

                <div class="card-tools">
                  <form action="{{ route('admin#orderSearch') }}" method="get">
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
                      <th>Customer Name</th>
                      <th>Pizza Name</th>
                      <th>Pizza Units</th>
                      <th>Payment</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($order as $item)
                      <tr>
                        <td>{{ $item->order_id }}</td>
                        <td>{{ $item->customerName }}</td>
                        <td>{{ $item->pizza_name }}</td>
                        <td>{{ $item->pizza_count }}</td>
                        <td>
                          @if ($item->payment_status == 1)
                            Credit
                          @elseif ($item->payment_status == 2)
                            Cash
                          @endif
                        </td>
                        <td>

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
