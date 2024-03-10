@extends('front')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Galery</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Galery</li>
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
                                            <img class="img-circle img-bordered-sm"
                                                src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">
                                            <span class="username">
                                                <a href="">Aguss</a>
                                                <a href="#" class="float-right btn-tool nav-link"
                                                    data-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></a>
                                                <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                    {{-- <a href="#" class="dropdown-item" data-toggle="modal"
                                                        data-target="#modal-update{{ $data->id }}">
                                                        <i class="fa fa-edit"></i> Edit
                                                    </a>
                                                    <a href="{{ url('timeline/' . $data->id) }}" class="dropdown-item"
                                                        onclick="return confirm('Yakin Untuk Di Hapus??/')">
                                                        <i class="fa fa-trash"></i> Delete
                                                    </a> --}}
                                                </div>
                                            </span>
                                            <span class="description">12-12-2024</span>
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row py-3">
                                            <div class="col-md-4"></div>
                                            <div class="col-md-4">
                                                <img src="{{ asset('image/120240305023451.jpg') }}" class="img-fluid"
                                                    alt="">
                                            </div>
                                            <div class="col-md-4"></div>
                                        </div>
                                        <h3>Tess Coment</h3>
                                        <p>
                                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora veritatis,
                                            quae, reprehenderit qui ab eos laboriosam inventore soluta amet temporibus, quia
                                            dolor! Ut, similique hic mollitia sunt reprehenderit amet veniam?
                                        </p>
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
                                        <a href="" class="text-primary">
                                            <span><i class="far fa-thumbs-up"></i></span>10
                                            Like
                                        </a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                        </p>
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                        src="{{ asset('DefaultImage/profil.jpeg') }}" alt="user image">

                                                </div>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="row pb-5">
                                                    <div class="col-md-12">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <span class="username">
                                                                    <a href=""
                                                                        class="text-decoration-none font-weight-bold text-dark">Aguss</a>
                                                                </span>
                                                                <a href="#"
                                                                    class="float-right text-dark">12-12-2024</a>
                                                                <br>
                                                                <p class="mt-2 mb-0">
                                                                    Lorem ipsum dolor sit amet consectetur, adipisicing
                                                                    elit.
                                                                    Distinctio,
                                                                    quisquam dolore harum voluptates est laboriosam atque
                                                                    eum
                                                                    necessitatibus
                                                                    soluta hic minus quis fugit facilis esse repellendus,
                                                                    deserunt
                                                                    delectus
                                                                    repudiandae ducimus.
                                                                </p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <a href="" class="text-primary">
                                                                    Like
                                                                </a>
                                                                <a href="" class="text-primary ml-2">
                                                                    Balas(3)
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <form action="">
                                            <input class="form-control form-control-sm" type="text"
                                                placeholder="Type a comment">
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
