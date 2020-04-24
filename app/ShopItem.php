<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopItem extends Model
{
    
	protected $table = "shop_items";
    public $primaryKey = "id";

    public function scopeActive($query) {
    	return $query->where('is_active', 1);
    }

    public function scopeDeleted($query) {
    	return $query->where('is_active', 0);
    }

    public function orders() {
    	return $this->belongsTo('App\ShopItemOrder', 'id', 'item_id');
    }


}
