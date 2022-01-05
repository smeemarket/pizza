@extends('admin.layout.app')

@section('content')
  <div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8 offset-3 mt-5">
            <div class="col-md-9">
              <a href="{{ route('admin#profile') }}" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i>
                Back
              </a>
              <div class="card mt-3">
                <div class="card-header p-2">
                  <legend class="text-center">Change Password</legend>
                </div>
                <div class="card-body">
                  @if (Session::has('notMatchError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('notMatchError') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  @if (Session::has('notSameError'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                      {{ Session::get('notSameError') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  @if (Session::has('lengthError'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                      {{ Session::get('lengthError') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      {{ Session::get('success') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif

                  <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                      <form action="{{ route('admin#changePassword', Auth()->user()->id) }}" method="POST"
                        class="form-horizontal">
                        @csrf
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-4 col-form-label">Old Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="oldPassword"
                              value="{{ old('oldPassword') }}">
                            @if ($errors->has('oldPassword'))
                              <small class="text-danger">{{ $errors->first('oldPassword') }}</small>
                            @endif
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-4 col-form-label">New Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="newPassword"
                              value="{{ old('newPassword') }}">
                            @if ($errors->has('newPassword'))
                              <small class="text-danger">{{ $errors->first('newPassword') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="inputPhone" class="col-sm-4 col-form-label">Confirm Password</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="confirmPassword"
                              value="{{ old('confirmPassword') }}">
                            @if ($errors->has('confirmPassword'))
                              <small class="text-danger">{{ $errors->first('confirmPassword') }}</small>
                            @endif
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="offset-sm-4 col-sm-8">
                            <button type="submit" class="btn btn-sm bg-dark text-white float-right">Change</button>
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
