<?php

namespace App;

use Carbon\Carbon;

use Illuminate\Database\Eloquent\Model;

class CategoryContent extends Model
{
    
	protected $table = "category_contents";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function scopePast($query) {
        return $query->whereDate('date_active', '<', Carbon::now());
    }

    public function scopeToday($query) {
        return $query->whereDate('date_active', '==', Carbon::now());
    }

    public function scopeFuture($query) {
        return $query->whereDate('date_active', '>', Carbon::now());
    } 

    public function category() {
    	return $this->belongsTo('App\Category', 'category_id', 'id');
    }

    public function comments() {
    	return $this->hasMany('App\ContentComment', 'id', 'content_id');
    }

}
