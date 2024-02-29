@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <h2 class="text-center display-4">Cari Teman Dengan Menggunakan PIN</h2>
        </div>
    </section>
    {{-- Helloo tesss --}}

    <!-- Main content -->
    <section class="content" style="height: 80vh">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <form action="{{ url('addfriend') }}" method="GET">
                        @csrf
                        <div class="input-group input-group-lg">
                            <input type="search" class="form-control form-control-lg" name="pin"
                                placeholder="Type your keywords here">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-lg btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @if (isset($add))
                <div class="row mt-3">
                    <div class="col-md-10 offset-md-1">
                        <div class="list-group">
                            <div class="list-group-item">
                                <div class="row">
                                    <div class="col-auto">
                                        <img class="profile-user-img img-fluid img-circle"
                                            src="{{ asset('image/220240226052530.jpeg') }}" alt="user image">
                                    </div>
                                    <div class="col px-4">
                                        <div>
                                            <h3>{{ $add->name }}</h3>
                                            <p class="mb-0 text-muted">{{ $add->pin }}</p>
                                            <p class="mb-4">{{ $add->username }}</p>
                                            <form action="{{ url('addfriend') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Add Friend</button>
                                                <input type="hidden" name="id_addto" value="{{ $add->id }}">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row py-4">
                    <div class="col-md-12">
                        <h1 class="text-center">Teman Belum Di Temukan</h1>
                    </div>
                </div>
            @endif

        </div>
    </section>
@endsection
