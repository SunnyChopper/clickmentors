<?php

namespace App\Http\Controllers;

use App\User

use Illuminate\Http\Request;

class UsersController extends Controller
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

	public function create_user(Request $data) {}

	public function read_user() {}

	public function update_user(Request $data) {}

	public function delete_user(Request $data) {}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_users() {}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

	public function login(Request $data) {}

}
