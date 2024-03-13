<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Friend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            // dd($result);
            $adds = User::whereIn('users.id', $result)
                ->leftJoin('friends as f1', function ($join) use ($user) {
                    $join->on('users.id', '=', 'f1.id_addto')
                        ->where('f1.id_add', $user->id);
                })
                ->leftJoin('friends as f2', function ($join) use ($user) {
                    $join->on('users.id', '=', 'f2.id_add')
                        ->where('f2.id_addto', $user->id);
                })
                ->select(
                    'users.*',
                    DB::raw('IFNULL(MAX(f1.confirm), "none") as addto_confirm'),
                    DB::raw('IFNULL(MAX(f1.confirm), "none") as addto_confirm'),
                    DB::raw('IFNULL(MAX(f1.id_add), "none") as addto_id'),
                    DB::raw('IFNULL(MAX(f1.id_addto), "none") as addto_idto'),
                    DB::raw('IFNULL(MAX(f2.id), "none") as idfriend'),
                    DB::raw('IFNULL(MAX(f2.confirm), "none") as add_confirm'),
                    DB::raw('IFNULL(MAX(f2.id_add), "none") as add_id'),
                    DB::raw('IFNULL(MAX(f2.id_addto), "none") as add_idto')
                )
                ->groupBy('users.id')
                ->get();



            // dd($adds);
            if ($adds) {
                // $friend = Friend::whereIn('id_addto', $result)->get();
                // $friends = Friend::whereIn('id_addto', $adds->pluck('id')->toArray())
                //     ->where('id_add', Auth::user()->id)
                //     ->get();
                // $friends = Friend::whereIn('id_addto', $result)
                //     ->join('users', 'users.id', '=', 'friends.id_add')
                //     ->where('friends.id_add', $user->id)
                //     ->select('users.*', 'friends.confirm', 'friends.id_add', 'friends.id as idfriend')
                //     ->get();
                // if ($friends) {
                // dd($friend);
                return view('Page.addfriend.addfriend', compact('adds'));
                // } else {
                // $addme = Friend::where('id_add', $result)->where('id_addto', $result)->first();
                // dd($addme);
                //     return view('Page.addfriend.addfriend', compact('add', 'friends'));
                // }
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
        // $user = Auth::user();
        // $friend = Friend::where('id', $id)->first();
        // dd($friend);

        $acc = [
            'confirm' => 'accept'
        ];
        Friend::where('id', $id)->update($acc);
        // Friend::create([
        //     'id_add' => $user->id,
        //     'id_addto' => $friend->id_add,
        //     'confirm' => 'accept',
        // ]);


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

    public function daftarteman()
    {
        $user = Auth::user();

        // $galery = Galery::where('id_user', $user->id)->latest()->get();
        $users = User::where('id', $user->id)->first();
        $countfriends = Friend::where(function ($query) use ($user) {
            $query->where('id_add', $user->id)
                ->orWhere('id_addto', $user->id);
        })
            ->where('confirm', 'accept')
            ->get();
        // dd($countfriends);

        $result = $countfriends->pluck('id_add')->merge($countfriends->pluck('id_addto'))->toArray();
        // dd($result);
        // $result = array_column($friendslist, 'id_addto');
        $friend = User::whereIn('id', $result)
            ->where('level', 'user')
            ->where('status', 1)
            ->whereNotIn('id', [$user->id])
            ->get();
        // dd($friend);

        return view('Page.addfriend.daftarteman', compact('users', 'countfriends', 'friend'));
    }

    public function unFriend($id)
    {
        $user = Auth::user();

        Friend::where('id_add', $user->id)
            ->where('id_addto', $id)
            ->delete();
        Friend::where('id_addto', $user->id)
            ->where('id_add', $id)
            ->delete();

        return back();
    }
}
