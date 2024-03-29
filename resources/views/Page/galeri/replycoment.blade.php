@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Reply Coment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Reply Coment</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            @if ($posting->profile)
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('image/' . $posting->profile) }}" alt="user image">
                                            @else
                                                <img class="img-circle img-bordered-sm"
                                                    src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                            @endif
                                            <span class="username">
                                                <a href="">{{ $posting->username }}</a>
                                                @if ($posting->iduser == Auth::user()->id)
                                                    <a href="#" class="float-right btn-tool nav-link"
                                                        data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
                                                    <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                        <a href="#" class="dropdown-item" data-toggle="modal"
                                                            data-target="#modal-update{{ $posting->id }}">
                                                            <i class="fa fa-edit"></i> Edit
                                                        </a>
                                                        <a href="{{ url('timeline/' . $posting->id) }}"
                                                            class="dropdown-item"
                                                            onclick="return confirm('Yakin Untuk Di Hapus??/')">
                                                            <i class="fa fa-trash"></i> Delete
                                                        </a>
                                                    </div>
                                                @endif
                                            </span>
                                            <span class="description">{{ $posting->created_at->diffForHumans() }}</span>
                                        </div>
                                        @if ($posting->foto)
                                            <div class="row py-3">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <img src="{{ asset('image/' . $posting->foto) }}" class="img-fluid"
                                                        alt="">
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                        @endif
                                        <!-- /.user-block -->
                                        <div class="row py-3">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <img src="{{ asset('image/120240305023451.jpg') }}" class="img-fluid"
                                                    alt="">
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <h3>{{ $posting->judul }}</h3>
                                        <p>
                                            {{ $posting->deskripsi }}
                                        </p>
                                        <hr>
                                        <p>
                                        <div class="btn-group dropup">
                                            <a href="#" class="text-dark mr-2" data-toggle="dropdown"><span>
                                                    <i class="fas fa-share mr-1"></i></span> Share</a>
                                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                                                <a href="" class="dropdown-item font-weight-bold text-sm">
                                                    <i class="fab fa-whatsapp"></i> Kirim WhatsApp
                                                </a>
                                            </div>
                                        </div>
                                        @php
                                            $likeCount = $countlikes->where('id_galery', $posting->id)->count();
                                            $userLiked = $countlikes
                                                ->where('id_galery', $posting->id)
                                                ->where('id_user', Auth::user()->id)
                                                ->count();
                                        @endphp
                                        @if ($userLiked)
                                            <a href="{{ url('like/' . $posting->id) }}" class="text-primary">
                                                <span><i class="far fa-thumbs-up"></i></span>{{ $likeCount }}
                                                Like
                                            </a>
                                        @else
                                            <a href="{{ url('like/' . $posting->id) }}" class="text-dark">
                                                <i class="far fa-thumbs-up"></i>
                                                @if ($likeCount >= 1)
                                                    {{ $likeCount }}
                                                    Like
                                                @else
                                                    Like
                                                @endif
                                            </a>
                                        @endif
                                        @php
                                            $comentCount = $countcoments->where('id_galery', $posting->id)->count();
                                        @endphp
                                        @if ($comentCount)
                                            <span class="float-right">
                                                <a href="{{ url('coment/' . $posting->id) }}" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments ({{ $comentCount }})
                                                </a>
                                            </span>
                                        @else
                                            <span class="float-right">
                                                <a href="#" class="link-black text-sm">
                                                    <i class="far fa-comments mr-1"></i> Comments
                                                </a>
                                            </span>
                                        @endif
                                        </p>
                                        <hr>
                                        <div class="row pb-4">
                                            <div class="col-auto">
                                                @if ($coment->profile)
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm"
                                                            src="{{ asset('image/' . $coment->profile) }}"
                                                            alt="user image">
                                                    </div>
                                                @else
                                                    <div class="user-block">
                                                        <img class="img-circle img-bordered-sm"
                                                            src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="col-md-11">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <span class="username">
                                                                    <a href=""
                                                                        class="text-decoration-none font-weight-bold text-dark">{{ $coment->username }}</a>
                                                                </span>
                                                                @if ($coment->id_user == Auth::user()->id)
                                                                    <a href="#" class="float-right btn-tool nav-link"
                                                                        data-toggle="dropdown"><i
                                                                            class="fas fa-ellipsis-v"></i></a>
                                                                    <div
                                                                        class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                                        <a href="#" class="dropdown-item"
                                                                            data-toggle="modal"
                                                                            data-target="#modal-updatecoment{{ $coment->id }}">
                                                                            <i class="fa fa-edit"></i> Edit
                                                                        </a>
                                                                    </div>
                                                                    <div class="modal fade"
                                                                        id="modal-updatecoment{{ $coment->id }}">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h4 class="modal-title">Update
                                                                                        Coment</h4>
                                                                                    <button type="button" class="close"
                                                                                        data-dismiss="modal"
                                                                                        aria-label="Close">
                                                                                        <span
                                                                                            aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <form
                                                                                    action="{{ url('coment/' . $coment->id) }}"
                                                                                    method="post"
                                                                                    enctype="multipart/form-data">
                                                                                    @method('PUT')
                                                                                    @csrf
                                                                                    <div class="modal-body">
                                                                                        <div class="form-group">
                                                                                            <textarea name="coment" required class="form-control" placeholder="Coment" rows="5">{{ $coment->coment }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="modal-footer justify-content-between">
                                                                                        <button type="button"
                                                                                            class="btn btn-default"
                                                                                            data-dismiss="modal">Close</button>
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary">Save
                                                                                            changes</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                            <!-- /.modal-content -->
                                                                        </div>
                                                                        <!-- /.modal-dialog -->
                                                                    </div>
                                                                @endif
                                                                <br>
                                                                <p class="mt-2 mb-0">
                                                                    {{ $coment->coment }}
                                                                </p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="#"
                                                                    class="text-dark">{{ $coment->created_at->locale('id')->diffForHumans() }}</a>
                                                                <a href="#" class="text-primary ml-2">
                                                                    @if ($replyComent >= 1)
                                                                        Balasan
                                                                        {{ $replyComent }}
                                                                    @else
                                                                        Balas
                                                                    @endif
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($dataReply)
                                                    @foreach ($dataReply as $data)
                                                        <div class="row">
                                                            <div class="col-auto">
                                                                <div class="col-auto">
                                                                    <div class="user-block">
                                                                        @if ($data->profile)
                                                                            <img class="img-circle img-bordered-sm"
                                                                                src="{{ asset('image/' . $data->profile) }}"
                                                                                alt="user image">
                                                                        @else
                                                                            <img class="img-circle img-bordered-sm"
                                                                                src="{{ asset('DefaultImage/profil.jpeg') }}"
                                                                                alt="user image">
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-11">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="card">
                                                                            <div class="card-body">
                                                                                <span class="username">
                                                                                    <a href=""
                                                                                        class="text-decoration-none font-weight-bold text-dark">{{ $data->username }}</a>
                                                                                </span>
                                                                                @if ($data->uid == Auth::user()->id)
                                                                                    <a href="#"
                                                                                        class="float-right btn-tool nav-link"
                                                                                        data-toggle="dropdown"><i
                                                                                            class="fas fa-ellipsis-v"></i></a>
                                                                                    <div
                                                                                        class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                                                        <a href="#"
                                                                                            class="dropdown-item"
                                                                                            data-toggle="modal"
                                                                                            data-target="#modal-updatereply{{ $data->id }}">
                                                                                            <i class="fa fa-edit"></i> Edit
                                                                                        </a>
                                                                                        <a href="{{ url('replycomentdelete/' . $data->id) }}"
                                                                                            class="dropdown-item"
                                                                                            onclick="return confirm('Yakin Untuk Di Hapus??/')">
                                                                                            <i class="fa fa-trash"></i>
                                                                                            Delete
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="modal fade"
                                                                                        id="modal-updatereply{{ $data->id }}">
                                                                                        <div class="modal-dialog modal-lg">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h4
                                                                                                        class="modal-title">
                                                                                                        Update
                                                                                                        ReplyComent</h4>
                                                                                                    <button type="button"
                                                                                                        class="close"
                                                                                                        data-dismiss="modal"
                                                                                                        aria-label="Close">
                                                                                                        <span
                                                                                                            aria-hidden="true">&times;</span>
                                                                                                    </button>
                                                                                                </div>
                                                                                                <form
                                                                                                    action="{{ url('replycoment/' . $data->id) }}"
                                                                                                    method="post"
                                                                                                    enctype="multipart/form-data">
                                                                                                    @method('PUT')
                                                                                                    @csrf
                                                                                                    <div
                                                                                                        class="modal-body">
                                                                                                        <div
                                                                                                            class="form-group">
                                                                                                            <textarea name="replycoment" required class="form-control" placeholder="ReplyComent" rows="5">{{ $data->replycoment }}</textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div
                                                                                                        class="modal-footer justify-content-between">
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-default"
                                                                                                            data-dismiss="modal">Close</button>
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-primary">Save
                                                                                                            changes</button>
                                                                                                    </div>
                                                                                                </form>
                                                                                            </div>
                                                                                            <!-- /.modal-content -->
                                                                                        </div>
                                                                                        <!-- /.modal-dialog -->
                                                                                    </div>
                                                                                @endif
                                                                                <p class="mt-2 mb-0">
                                                                                    {{ $data->replycoment }}
                                                                                </p>
                                                                            </div>
                                                                            <div class="card-footer">
                                                                                <a href="#"
                                                                                    class="text-dark">{{ $data->created_at->locale('id')->diffForHumans() }}</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <form action="{{ url('replycoment') }}" method="POST">
                                            @csrf
                                            <input class="form-control form-control-sm" type="text" name="replycoment"
                                                placeholder="Type a comment">
                                            <input type="hidden" name="id_coment" value="{{ $coment->id }}">
                                        </form>
                                    </div>
                                    <!-- /.post -->
                                </div>

                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
