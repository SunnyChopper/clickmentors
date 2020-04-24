<?php

namespace App\Http\Controllers;

use App\User;
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

	public function create_shop_item(Request $data) {
		$item = new ShopItem;
		$item->points = $data->points;
		$item->cover_image = $data->cover_image;
		$item->title = $data->title;
		$item->description = $data->description;
		$item->save();

		return response()->json([
			'success' => true,
			'item' => $item->toArray()
		], 200);
	}

	public function read_shop_item() {
		if (isset($_GET['item_id'])) {
			$item = ShopItem::find($_GET['item_id']);

			return response()->json([
				'success' => true,
				'item' => $item->toArray(),
				'orders' => $item->orders()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify an item id.'
			], 200);
		}
	}

	public function update_shop_item(Request $data) {
		$item = ShopItem::find($data->item_id);

		if (isset($data->points)) {
			$item->points = $data->points;
		}

		if (isset($data->cover_image)) {
			$item->cover_image = $data->cover_image;
		}

		if (isset($data->title)) {
			$item->title = $data->title;
		}

		if (isset($data->description)) {
			$item->description = $data->description;
		}

		$item->save();

		return response()->json([
			'success' => true,
			'item' => $item->toArray()
		], 200);
	}

	public function delete_shop_item(Request $data) {
		$item = ShopItem::find($data->item_id);
		$item->is_active = 0;
		$item->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function create_shop_item_order(Request $data) {
		$user = User::find($data->user_id);
		$item = ShopItem::find($data->item_id);

		if ($item->points > $user->points) {
			return response()->json([
				'success' => false,
				'error' => 'You do not have enough points to purchase this.'
			], 200);
		}

		$user->points = $user->points - $item->points;
		$user->save();

		$order = new ShopItemOrder;
		$order->user_id = $data->user_id;
		$order->item_id = $data->item_id;
		$order->save();

		return response()->json([
			'success' => true,
			'order' => $order->toArray(),
			'user' => $user->toArray()
		], 200);
	}

	public function read_shop_item_order() {
		if (isset($_GET['order_id'])) {
			$order = ShopItemOrder::find($_GET['order_id']);

			return response()->json([
				'success' => true,
				'order' => $order->toArray(),
				'user' => $order->user()->toArray(),
				'item' => $order->item()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify an order id.'
			], 200);
		}
	}

	public function update_shop_item_order(Request $data) {
		$order = ShopItemOrder::find($data->order_id);

		if (isset($data->status)) {
			$order->status = $data->status;
		}

		$order->save();

		return response()->json([
			'success' => true,
			'order' => $order->toArray()
		], 200);
	}

	public function delete_shop_item_order(Request $data) {
		$order = ShopItemOrder::find($data->order_id);

		if ($order->status == 1) {
			$order->status = 0;
			$order->save();

			$item = ShopItem::find($order->item_id);
			$user = User::find($order->user_id);

			$user->points = $user->points + $item->points;
			$user->save();

			return response()->json([
				'success' => true,
				'user' => $user->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'You can no longer delete this order.'
			], 200);
		}
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_shop_items() {
		return response()->json([
			'success' => true,
			'items' => ShopItem::active()->get()->toArray()
		], 200);
	}

	public function get_shop_item_orders() {
		if (isset($_GET['user_id'])) {
			$orders = ShopItemOrder::where('user_id', $_GET['user_id'])->active()->get();

			$return_array = array();
			foreach($orders as $order) {
				$temp_array = array();
				$temp_array['order'] = $order->toArray();
				$temp_array['user'] = $order->user()->toArray();
				$temp_array['item'] = $order->item()->toArray();
				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'orders' => $return_array
			], 200);
		} else if (isset($_GET['item_id'])) {
			$orders = ShopItemOrder::where('item_id', $_GET['item_id'])->active()->get();

			$return_array = array();
			foreach($orders as $order) {
				$temp_array = array();
				$temp_array['order'] = $order->toArray();
				$temp_array['user'] = $order->user()->toArray();
				$temp_array['item'] = $order->item()->toArray();
				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'orders' => $return_array
			], 200);
		} else {
			return response()->json([
				'success' => true,
				'orders' => ShopItemOrder::where('status', '!=', 0)->get()->toArray()
			], 200);
		}
	}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

}
