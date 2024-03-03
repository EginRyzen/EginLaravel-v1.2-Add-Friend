@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Profile</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                @if ($users->profile)
                                    <img class="profile-user-img img-fluid img-circle"
                                        id="previewProfile{{ $users->id }}" src="{{ asset('image/' . $users->profile) }}"
                                        alt="User profile picture">
                                @else
                                    <img class="profile-user-img img-fluid img-circle"
                                        id="previewProfile{{ $users->id }}" src="{{ asset('DefaultImage/profil.jpeg') }}"
                                        alt="User profile picture">
                                @endif
                            </div>

                            <h3 class="profile-username text-center">{{ Auth::user()->username }}</h3>

                            <p class="text-muted text-center">{{ Auth::user()->name }}</p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <a href="" class="text-dark"><b>Friends</b> <span class="float-right"><i
                                                class="fa fa-user"></i>
                                            {{ count($countfriends) }}</span></a>
                                </li>
                            </ul>

                        </div>
                        <!-- /.card-body -->
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity"
                                        data-toggle="tab">Activity</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header --> --}}
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="row p-3">
                                                <div class="col-auto">
                                                    <img class="profile-user-img img-fluid img-circle mt-3"
                                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                </div>
                                                <div class="col px-4">
                                                    <div>
                                                        <h3>Egin</h3>
                                                        <p class="mb-0 text-muted">abvshs</p>
                                                        <p class="mb-2">Agus</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-4">
                                        <div class="card">
                                            <div class="row p-3">
                                                <div class="col-auto">
                                                    <img class="profile-user-img img-fluid img-circle mt-3"
                                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                </div>
                                                <div class="col px-4">
                                                    <div>
                                                        <a href=""
                                                            class="fs-1x  float-right font-weight-bold">...</a>
                                                        <h3>Egin</h3>
                                                        <p class="mb-0 text-muted">abvshs</p>
                                                        <p class="mb-2">Agus</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
    </section>
    <!-- /.content -->
@endsection
