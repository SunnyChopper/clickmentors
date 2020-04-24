<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    
	protected $table = "comment_replies";
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

    public function comment() {
    	return $this->belongsTo('App\User', 'comment_id', 'id');
    }

}
