@extends('admin.layout.app')

@section('content')

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <button onclick="goBack()" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i>
                Back
              </button>
              <div class="card mt-3">
                <div class="card-header p-2">
                  <legend class="text-center">Pizza Information</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="px-md-3 active tab-pane" id="activity">

                      <div class="text-center">
                        <img src="{{ asset('uploads/' . $pizza->image) }}" class="rounded-circle img-thumbnail"
                          style="width: 120px;height: 120px">
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Name</b> : {{ $pizza->pizza_name }}
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Price</b> : {{ $pizza->price }}
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Publish Status</b> :
                        @if ($pizza->publish_status == '1')
                          Publish
                        @else
                          Unpublish
                        @endif
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Category</b> : {{ $pizza->category_id }}
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Discount Price</b> : {{ $pizza->discount }} Kyats
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Buy 1 Get 1</b> :
                        @if ($pizza->buy_one_get_one_status == '1')
                          YES
                        @else
                          No
                        @endif
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Waiting Time</b> : {{ $pizza->waiting_time }}
                      </div>

                      <div class="row mt-2">
                        <b class="col-4">Description</b> : {{ $pizza->description }}
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@endsection
