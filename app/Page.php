<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['social_media_token', 'name','user_id'];

    public function tokens()
    {
        return $this->hasMany(Token::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function alreadyExist() : boolean 
    {
        return !empty($this->where('social_media_token', $this->social_media_token)->first());
    }

    /**
     * Search for page with the given attributes. 
     * if no one was found, return itself
     * @return App\Page
     */
    public function getFetchedOrItself()
    {
        $fetched = $this->where('social_media_token', $this->social_media_token)->first();
        return $fetched ? : $this;
    }
}
