    @extends('front')

    @section('content')
        <section class="content-header">
            <div class="container-fluid">
                <h2 class="text-center display-4">Cari Teman Dengan Menggunakan PIN</h2>
            </div>
        </section>
        {{-- Helloo tesss --}}

        <!-- Main content -->
        <section class="content">
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
                @if (isset($adds))
                    @foreach ($adds as $add)
                        <div class="row mt-3">
                            <div class="col-md-10 offset-md-1">
                                <div class="list-group">
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-auto">
                                                @if ($add->profile)
                                                    <img class="profile-user-img img-fluid img-circle mt-3" a
                                                        src="{{ asset('image/' . $add->profile) }}" alt="user image">
                                                @else
                                                    @if (!$add->profile && Auth::user()->profile)
                                                        <img class="profile-user-img img-fluid img-circle mt-3"
                                                            src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                    @elseif (!$add->profile && !Auth::user()->profile)
                                                        <img class="profile-user-img img-fluid img-circle mt-3"
                                                            src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                    @else
                                                        <img class="profile-user-img img-fluid img-circle mt-3"aaa
                                                            src="{{ asset('image/' . Auth::user()->profile) }}"
                                                            alt="user image">
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="col px-4">
                                                <div>
                                                    @if ($add->id == Auth::user()->id)
                                                        <a href="{{ url('profile') }}">
                                                            <h3>{{ $add->name }}</h3>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('profileUser/' . $add->id) }}">
                                                            <h3>{{ $add->name }}</h3>
                                                        </a>
                                                    @endif
                                                    {{-- <p class="mb-0 text-muted">{{ $add->id_addto }}</p> --}}
                                                    <p class="mb-2">{{ $add->username }}</p>
                                                    {{-- @php
                                                    // $liked = $countlikes->contains('id_galery', $data->id);
                                                    $likeCount = $countlikes->where('id_galery', $data->id)->count();
                                                    $userLiked = $countlikes
                                                        ->where('id_galery', $data->id)
                                                        ->where('id_user', Auth::user()->id)
                                                        ->count();
                                                @endphp --}}
                                                    @if ($add->id == Auth::user()->id)
                                                        <button type="button" class="btn btn-success"><i
                                                                class="fa fa-user"></i></button>
                                                    @else
                                                        @if ($add->add_idto == Auth::user()->id && $add->add_confirm == 'pending')
                                                            <a href="{{ url('addfriend/' . $add->idfriend) }}"
                                                                class="btn btn-primary btn-sm mt-1">Konfirmasi</a>
                                                        @elseif ($add->addto_confirm == 'pending' || $add->add_confirm == 'pending')
                                                            <button type="button" class="btn btn-secondary"><i
                                                                    class="fas fa-user-minus"></i></button>
                                                        @elseif ($add->addto_confirm == 'accept' || $add->add_confirm == 'accept')
                                                            <button type="button" class="btn btn-success"><i
                                                                    class="fas fa-user-check"></i></button>
                                                        @else
                                                            <form action="{{ url('addfriend') }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn btn-primary"><i
                                                                        class="fas fa-user-plus"></i></button>
                                                                <input type="hidden" name="id_addto"
                                                                    value="{{ $add->id }}">
                                                            </form>
                                                        @endif
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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
