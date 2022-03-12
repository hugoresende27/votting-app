<?php

namespace App\Http\Controllers;

use auth;
use App\Models\Channel;
use Illuminate\Http\Request;
use App\Models\CommunityLink;
use App\Exceptions\CommunityLinkAlreadySubmitted;
// use Illuminate\Support\Facades\Auth;

class CommunityLinksController extends Controller
{
    //

    public function index()
    {
        //display all community links

        $links = CommunityLink::where('approved',1)->latest('updated_at')->paginate(25);
        $channels = Channel::orderBy('title')->get();

        // flash("MESSAGE Teste", "msg-warning");
        // flash("MESSAGE Teste", "msg-ok");
        return view ('community.index', compact('links','channels'));
    }

    public function store(Request $request)
    {
        // CommunityLink::create($request->all());

        // auth()->user()->contributeLink();

        // $request->user_id = Auth::id();

        $this->validate($request, [

            'channel_id'=>'required|exists:channels,id',
            'title'=>'required',
            'link'=>'required'

        ]);

        try{

            CommunityLink::from(auth()->user())->contribute($request->all());

            if(Auth::user()->isTrusted())
            {
                flash("Thanks for your contribution", "msg-ok");
            }
            else
            {
                flash("Thanks, this will be submitted to approval!", "msg-warning");
            }

        }catch (CommunityLinkAlreadySubmitted $e){
            flash()->overlay("We'ill instead bump the timestamps and bring that link back to the top. Thanks!", 'That link has already been submitted');
        }

        //aqui estou a dizer q o user quando faz um post passa a ter valor trusted true(1) e save 
        // auth()->user()->trusted = true;
        // auth()->user()->save();

     


        return back();
    }
}
