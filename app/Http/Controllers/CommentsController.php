<?php

namespace App\Http\Controllers;

use App\CommentReply;
use App\ContentComment;

use Illuminate\Http\Request;

class CommentsController extends Controller
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

	public function create_comment(Request $data) {}

	public function read_comment() {}

	public function update_comment(Request $data) {}

	public function delete_comment(Request $data) {}

	public function create_comment_reply(Request $data) {}

	public function read_comment_reply() {}

	public function update_comment_reply(Request $data) {}

	public function delete_comment_reply(Request $data) {}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_comments() {}

	public function get_comment_replies() {}

	/* --------------------- *\
	|  3. View Functions      |
	\* --------------------- */

	/* --------------------- *\
	|  4. Helper Functions    |
	\* --------------------- */

}
