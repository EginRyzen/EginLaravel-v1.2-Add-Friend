<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Coment;
use App\Models\Galery;
use App\Models\ReplyComent;
use Illuminate\Http\Request;

class ReplyComentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $posting = Galery::join('users', 'users.id', '=', 'galeries.id_user')
            ->where('galeries.id', $id)
            ->select('galeries.*', 'users.username', 'users.id as iduser', 'users.profile')
            ->first();

        $countlikes = Like::where('id_galery', $id)->get();
        $countcoments = Coment::where('id_galery', $id)->get();
        // dd($countlikes);
        $coments = Coment::join('users', 'users.id', '=', 'coments.id_user')
            ->where('id_galery', $id)
            ->select('coments.*', 'users.username', 'users.id as iduser')
            ->first();

        return view('Page.galeri.coment', compact('coments', 'posting', 'countlikes', 'countcoments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplyComent  $replyComent
     * @return \Illuminate\Http\Response
     */
    public function show(ReplyComent $replyComent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReplyComent  $replyComent
     * @return \Illuminate\Http\Response
     */
    public function edit(ReplyComent $replyComent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReplyComent  $replyComent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReplyComent $replyComent)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReplyComent  $replyComent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReplyComent $replyComent)
    {
        //
    }
}
