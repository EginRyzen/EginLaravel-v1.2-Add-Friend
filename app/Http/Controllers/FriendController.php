<?php

namespace App\Http\Controllers;

use App\Models\Friend;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FriendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $pin = $request->pin;
        if (isset($pin)) {
            $search = User::where(function ($query) use ($pin) {
                $query->where('name', 'LIKE', '%' . $pin . '%')
                    ->orWhere('username', 'LIKE', '%' . $pin . '%');
            })
                ->where('level', 'user')
                ->where('status', 1)
                ->get()
                ->toArray();

            // dd($search);
            $result = array_column($search, 'id');
            $add = User::whereIn('id', $result)
                ->where('level', 'user')
                ->where('status', 1)
                ->get();

            // dd($add);
            if ($result) {
                $friend = Friend::where('id_add', $user->id)->where('id_addto', $result)->first();
                // dd($friend);
                if ($friend) {
                    return view('Page.addfriend.addfriend', compact('add', 'friend'));
                } else {
                    $addme = Friend::where('id_add', $result)->where('id_addto', $result)->first();
                    // dd($addme);
                    return view('Page.addfriend.addfriend', compact('add', 'friend', 'addme'));
                }
            } else {
                return view('Page.addfriend.addfriend');
            }
        } else {
            return view('Page.addfriend.addfriend');
        }
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
        $idaddto = $request->id_addto;
        $user = Auth::user();

        $data = [
            'id_addto' => $idaddto,
            'id_add' => $user->id,
        ];

        Friend::create($data);
        return redirect('timeline');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $friend = Friend::where('id', $id)->first();
        // dd($friend);

        $acc = [
            'confirm' => 'accept'
        ];
        Friend::where('id', $id)->update($acc);
        Friend::create([
            'id_add' => $user->id,
            'id_addto' => $friend->id_add,
            'confirm' => 'accept',
        ]);


        return back()->with('success', 'Success Your Confirm');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function edit(Friend $friend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Friend $friend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Friend  $friend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Friend $friend)
    {
        //
    }
}
