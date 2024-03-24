<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Coment;
use App\Models\Galery;
use App\Models\ReplyComent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReplyComentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
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
        // dd($request->input());
        $user = Auth::user();

        $data = [
            'id_user' => $user->id,
            'id_coment' => $request->id_coment,
            'replycoment' => $request->replycoment,
        ];

        ReplyComent::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReplyComent  $replyComent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $coment = Coment::join('users', 'users.id', '=', 'coments.id_user')
            ->where('coments.id', $id)
            ->select('coments.*', 'users.username', 'users.profile', 'users.id as iduser')
            ->first();
        // dd($coment);

        $posting = Galery::join('users', 'users.id', '=', 'galeries.id_user')
            ->where('galeries.id', $coment->id_galery)
            ->select('galeries.*', 'users.username', 'users.id as iduser', 'users.profile')
            ->first();
        // dd($posting);

        $countlikes = Like::where('id_galery', $posting->id)->get();
        $countcoments = Coment::where('id_galery', $posting->id)->get();
        $replyComent = ReplyComent::where('id_coment', $coment->id)->count();
        // dd($replyComent);

        $dataReply = ReplyComent::join('users', 'users.id', '=', 'reply_coments.id_user')
            ->join('coments', 'coments.id', '=', 'reply_coments.id_coment')
            ->where('coments.id', $id)
            ->select('reply_coments.*', 'users.username', 'users.profile', 'users.id as uid')
            ->get();
        // dd($dataReply);

        return view(
            'Page.galeri.replycoment',
            compact('coment', 'posting', 'countlikes', 'countcoments', 'replyComent', 'dataReply')
        );
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
    public function update(Request $request, $id)
    {
        $data = [
            'replycoment' => $request->replycoment,
        ];

        ReplyComent::where('id', $id)->update($data);

        return back();
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

    public function delete($id)
    {
        ReplyComent::where('id', $id)->delete();

        return back();
    }
}
