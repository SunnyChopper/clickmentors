<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    
	protected $table = "categories";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function content() {
    	return $this->hasMany('App\CategoryContent', 'id', 'category_id');
    }

}
