@extends('layouts.app')
<title>Sanad | User Management</title>
@section('content')
    <!-- Main content -->
        <div class="container-fluid">
            <!-- /.col -->
            <div class="profile-form">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">User management</a></li>
                        <li class="breadcrumb-item active" aria-current="page">edit</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-body pt-5">
                    <div class="tab-content edit-profile-main-sec">
                        <div class="tab-pane active" id="settings">
                          @if(isset($org_id))
                          <form class="form-horizontal" method="POST" action="{{ route('org-users-management.update') }}" enctype="multipart/form-data">
                            <input type="hidden" name="org_id" value="{{ $org_id }}">
                          @else
                            <form class="form-horizontal" method="POST" action="{{ route('users-management.update', $user->id) }}" enctype="multipart/form-data">
                              @method('put')
                          @endif

                            @csrf

                            <input type="hidden" name="edit_type" value="admin_edit">
                            <input type="hidden" name="id" value="{{ $user->id }}">

                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Upload Logo</label>
                                <div class="col-sm-10 input-group edit-input-field">
                                    @if (!empty($user->avatar) && $user->avatar!="user-avatar.png")
                                        <div class="thumb_img">
                                            <img src="{{url('images/profile')}}/{{ $user->avatar }}" class="img-thumbnail" id="image-thumb">
                                        </div>
                                    @endif
                                    <div class="custom-file">
                                      <input
                                      type="file"
                                      name="avatar"
                                      value="{{ $user->avatar }}"
                                      class="form-control custom-file-input @error('avatar') is-invalid @enderror"
                                      id="userProfile"
                                      accept="image/*">
                                      <label class="custom-file-label" for="userProfile">Choose file</label>
                                      Upload
                                    </div>
                                    <div class="input-group-append">
                                        <a class="input-group-text btn btn-danger profile-pic-remove" id="removeProfile">Remove</a>
                                    </div>
                                    @error('avatar')
                                    <span class="invalid-feedback" role="alert" style="display:block">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName" placeholder="Name" value="{{ $user->name }}">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" placeholder="Email" value="{{ $user->email }}">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- <div class="form-group row">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Role</label>
                                <div class="col-sm-10">

                                </div>
                            </div> -->
                            <input type="hidden" name="removeProfile" id="input-removeProfile" value=false>
                            <div class="form-group row">
                            <div class="offset-sm-2 col-sm-10 text-right">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            </div>
                        </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div><!-- /.container-fluid -->
    <!-- /.content -->
@endsection
