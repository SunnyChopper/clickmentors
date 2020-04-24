<?php

namespace App\Http\Controllers;

use App\ShopItem;
use App\ShopItemOrder;

use Illuminate\Http\Request;

class ShopItemsController extends Controller
{
    
	/* ---------------------------- *\
	|  Feature Controller            |
	|--------------------------------|
	|  1. CRUD Functions             |
	|  2. Get Functions              |
	|  3. View Functions             |
	|  4. Helper Functions           |
	\* ---------------------------- */

	/* --------------------- *\
	|  1. CRUD Functions      |
	\* --------------------- */

	public function create_shop_item(Request $data) {}

	public function read_shop_item() {}

	public function update_shop_item(Request $data) {}

	public function delete_shop_item(Request $data) {}

	public function create_shop_item_order(Request $data) {}

	public function read_shop_item_order() {}

	public function update_shop_item_order(Request $data) {}

	public function delete_shop_item_order(Request $data) {}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_shop_items() {}

	public function get_shop_item_orders() {}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

}
