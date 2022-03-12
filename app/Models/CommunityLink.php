<?php

namespace App\Models;

use App\Models\User;
use App\Models\Channel;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CommunityLinkAlreadySubmitted;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CommunityLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'channel_id',
        'title',
        'link',
        // 'user_id'
        'approved'
    ];

   

    public static function from (User $user)
    {
        $link = new static;

        $link->user_id = $user->id;

        // //temporary
        // // $link->channel_id = 1;

        if ($user->isTrusted()) {
            $link->approve();
        }

        return $link;
        // dd($user);
        // return new static (['user_id' => $user->id]);
    }

    //CONTRIBUTE THE GIVEN COMMUNITY LINK
    public function contribute($attributes)
    {

        // dd(get_defined_vars());
        if(($existing = $this->hasAlreadyBeenSubmitted($attributes['link'])))
        {
            return $existing->touch();
            dd(get_defined_vars());
            throw new CommunityLinkAlreadySubmitted;
        }
        return $this->fill($attributes)->save();
    }

    //MARK THE COMMUNITY LINK AS APPROVED
    public function approve() 
    {
        $this->approved = true;

        return $this;
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');//foreign_key:user_id(communitylinks_table) local_key:id(users_table)
    }


    //COMMUNITY LINK IS ASSIGNED IN THE CHANNEL
    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }


    //DETERMENIND IF THE LINK HAS ALREADY BEEN SUBMITTED
    public function hasAlreadyBeenSubmitted($link)
    {
        return static::where('link', $link)->first();
    }

}
