<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

	public function create_user(Request $data) {
		if (User::where('email', $data->email)->active()->count() > 0) {
			return response()->json([
				'success' => false,
				'error' => 'Email already associated with email.'
			], 200);
		} else {
			$user = new User;
			$user->first_name = $data->first_name;
			$user->last_name = $data->last_name;
			$user->email = $data->email;
			$user->password = Hash::make($data->password);
			$user->points = 0;
			$user->save();

			return response()->json([
				'success' => true,
				'user' => $user->toArray()
			], 200);
		}
	}

	public function read_user() {
		if (isset($_GET['user_id'])) {
			$user = User::find($_GET['user_id']);

			return response()->json([
				'success' => true,
				'user' => $user->toArray(),
				'comments' => $user->comments()->toArray(),
				'replies' => $user->replies()->toArray(),
				'comments' => $user->comments()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a user id.'
			], 200);
		}
	}

	public function update_user(Request $data) {
		$user = User::find($data->user_id);

		if (isset($data->email)) {
			$user->email = $data->email;
		}

		if (isset($data->first_name)) {
			$user->first_name = $data->first_name;
		}

		if (isset($data->last_name)) {
			$user->last_name = $data->last_name;
		}

		if (isset($data->password)) {
			$user->password = Hash::make($data->password);
		}

		if (isset($data->points)) {
			$user->points = $data->points;
		}

		$user->save();

		return response()->json([
			'success' => true,
			'user' => $user->toArray()
		], 200);
	}

	public function delete_user(Request $data) {
		$user = User::find($data->user_id);
		$user->is_active = 0;
		$user->save();

		return response()->json([
			'success' => true
		], 200);
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_users() {
		return response()->json([
			'success' => true,
			'users' => User::active()->get()->toArray()
		], 200);
	}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

	public function login(Request $data) {
		if (User::where('email', $data->email)->count() > 0) {
			$user = User::where('email', $data->email)->first();
			if (Hash::check($data->password, $user->password)) {
				return response()->json([
					'success' => true,
					'user' => $user->toArray()
				], 200);
			} else {
				return response()->json([
					'success' => false,
					'error' => 'Password is incorrect.'
				], 200);
			}
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Email is not associated with any account.'
			], 200);
		}
	}

}
