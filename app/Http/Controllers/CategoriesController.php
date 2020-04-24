<?php

namespace App\Http\Controllers;

use App\Category;
use App\UserCategory;
use App\CategoryContent;

use Illuminate\Http\Request;

class CategoriesController extends Controller
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

	public function create_category(Request $data) {
		$category = new Category;
		$category->title = $data->title;
		$category->description = $data->description;
		$category->cover_image = $data->cover_image;
		$category->save();

		return response()->json([
			'success' => true,
			'category' => $category->toArray()
		], 200);
	}

	public function read_category() {
		if (isset($_GET['category_id'])) {
			return response()->json([
				'success' => true,
				'category' => Category::find($_GET['category_id'])->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a category id.'
			], 200);
		}
	}

	public function update_category(Request $data) {
		$category = Category::find($data->category_id);

		if (isset($data->title)) {
			$category->title = $data->title;
		}

		if (isset($data->description)) {
			$category->description = $data->description;
		}

		if (isset($data->cover_image)) {
			$category->cover_image = $data->cover_image;
		}

		$category->save();

		return response()->json([
			'success' => true,
			'category' => $category->toArray()
		], 200);
	}

	public function delete_category(Request $data) {
		$category = Category::find($data->category_id);
		$category->is_active = 0;
		$category->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function create_user_categories(Request $data) {
		$user_categories = UserCategory::where('user_id', $data->user_id)->get();
		foreach($user_categories as $old) {
			$old->delete();
		}

		$return_array = array();
		foreach($data->category_ids as $new) {
			$user_category = new UserCategory;
			$user_category->user_id = $data->user_id;
			$user_category->category_id = $new;
			$user_category->save();

			array_push($return_array, $user_category->toArray());
		}

		return response()->json([
			'success' => true,
			'user_categories' => $return_array
		], 200);
	}

	public function read_user_category() {
		if (isset($_GET['user_category_id'])) {
			$user_category = UserCategory::find($_GET['user_category_id']);

			return response()->json([
				'success' => true,
				'user_category' => $user_category->toArray(),
				'category' => $user_category->category()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a user category id.'
			], 200);
		}
	}

	public function create_category_content(Request $data) {
		$content = new CategoryContent;
		$content->category_id = $data->category_id;
		$content->points = $data->points;
		$content->content_type = $data->content_type;
		$content->title = $data->title;
		$content->question = $data->question;
		$content->video_id = $data->video_id;
		$content->link = $data->link;
		$content->date_active = $data->date_active;
		$content->save();

		return response()->json([
			'success' => true,
			'content' => $content->toArray()
		], 200);
	}

	public function read_category_content() {
		if (isset($_GET['content_id'])) {
			$content = CategoryContent::find($_GET['content_id']);

			return response()->json([
				'success' => true,
				'content' => $content->toArray(),
				'category' => $content->category()->toArray(),
				'comments' => $content->comments()->toArray()
			], 200);
		}
	}

	public function update_category_content(Request $data) {
		$content = CategoryContent::find($data->content_id);

		if (isset($data->category_id)) {
			$content->category_id = $data->category_id;
		}

		if (isset($data->points)) {
			$content->points = $data->points;
		}

		if (isset($data->content_type)) {
			$content->content_type = $data->content_type;
		}

		if (isset($data->title)) {
			$content->title = $data->title;
		}

		if (isset($data->question)) {
			$content->question = $data->question;
		}

		if (isset($data->video_id)) {
			$content->video_id = $data->video_id;
		}

		if (isset($data->link)) {
			$content->link = $data->link;
		}

		if (isset($data->date_active)) {
			$content->date_active = $data->date_active;
		}

		$content->save();

		return response()->json([
			'success' => true,
			'content' => $content->toArray()
		], 200);
	}

	public function delete_category_content(Request $data) {
		$content = CategoryContent::find($data->content_id);
		$content->is_active = 0;
		$content->save();
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_categories() {
		return response()->json([
			'success' => true,
			'categories' => Category::active()->get()->toArray()
		], 200);
	}

	public function get_user_categories() {
		if (isset($_GET['user_id'])) {
			return response()->json([
				'success' => true,
				'user_categories' => UserCategory::where('user_id', $_GET['user_id'])->get()->toArray()
			], 200);
		} else if (isset($_GET['category_id'])) {
			return response()->json([
				'success' => true,
				'user_categories' => UserCategory::where('category_id', $_GET['category_id'])->get()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify either a category id or a user id.'
			], 200);
		}
	}

	public function get_category_content() {
		if (isset($_GET['category_id'])) {
			return response()->json([
				'success' => true,
				'content' => CategoryContent::where('category_id', $_GET['category_id'])->get()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a category id.'
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
