<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItemOrder extends Model
{
    
	protected $table = "shop_item_orders";
    public $primaryKey = "id";

    public function scopeCompleted($query) {
    	return $query->where('status', 4);
    }

    public function scopeWaiting($query) {
    	return $query->where('status', 3);
    }

    public function scopeInProgress($query) {
    	return $query->where('status', 2);
    }

    public function scopeActive($query) {
    	return $query->where('status', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('status', 0);
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function item() {
    	return $this->belongsTo('App\ShopItem', 'item_id', 'id');
    }

}
