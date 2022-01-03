@extends('admin.layout.app')

@section('content')

  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <a href="{{ route('admin#category') }}" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i>
                Back
              </a>
              <div class="card mt-3">
                <div class="card-header p-2">
                  <legend class="text-center">Add Category</legend>
                </div>
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form method="POST" action="{{ route('admin#addCategory') }}" class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="inputName" placeholder="Name" name="name">
                            @if ($errors->has('name'))
                              <small class="text-danger">{{ $errors->first('name') }}</small>
                            @endif
                          </div>

                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn bg-dark text-white">Add</button>
                          </div>
                        </div>
                      </form>

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
