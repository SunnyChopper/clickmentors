<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentComment extends Model
{
    
	protected $table = "content_comments";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function content() {
    	return $this->belongsTo('App\CategoryContent', 'content_id', 'id');
    }

    public function replies() {
    	return $this->hasMany('App\CommentReply', 'id', 'comment_id');
    }

}
