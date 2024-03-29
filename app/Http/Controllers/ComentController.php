<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Coment;
use App\Models\Galery;
use App\Models\ReplyComent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ComentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $user = Auth::user();

        $data = [
            'id_user' => $user->id,
            'id_galery' => $request->id_galery,
            'coment' => $request->coment,
        ];
        // dd($data);

        Coment::create($data);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            ->select('coments.*', 'users.username', 'users.profile', 'users.id as iduser')
            ->get();
        // dd($coments);
        $array = $coments->pluck('id')->toArray();

        $replyComent = ReplyComent::whereIn('id_coment', $array)->get();
        // dd($replyComent);

        return view('Page.galeri.coment', compact('coments', 'posting', 'countlikes', 'countcoments', 'replyComent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function edit(Coment $coment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $data = [
            'coment' => $request->coment,
        ];

        Coment::where('id', $id)->update($data);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coment  $coment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coment $coment)
    {
        //
    }

    public function delete($id)
    {
        Coment::where('id', $id)->delete();

        return back();
    }
}
