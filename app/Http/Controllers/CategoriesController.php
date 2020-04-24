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

	public function create_category(Request $data) {}

	public function read_category() {}

	public function update_category(Request $data) {}

	public function delete_category(Request $data) {}

	public function create_user_category(Request $data) {}

	public function read_user_category() {}

	public function update_user_category(Request $data) {}

	public function delete_user_category(Request $data) {}

	public function create_category_content(Request $data) {}

	public function read_category_content() {}

	public function update_category_content(Request $data) {}

	public function delete_category_content(Request $data) {}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_categories() {}

	public function get_user_categories() {}

	public function get_category_content() {}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

}
