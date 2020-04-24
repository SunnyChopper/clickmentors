<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserCategory extends Model
{
    
	protected $table = "user_categories";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function category() {
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
