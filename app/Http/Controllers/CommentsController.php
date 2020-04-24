<?php

namespace App\Http\Controllers;

use App\User;
use App\CommentReply;
use App\ContentComment;
use App\CategoryContent;

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

	public function create_comment(Request $data) {
		$comment = new ContentComment;
		$comment->content_id = $data->content_id;
		$comment->user_id = $data->user_id;
		$comment->comment = $data->comment;
		$comment->save();

		$content = CategoryContent::find($data->content_id);
		$user = User::find($data->user_id);
		$user->points = $user->points + $content->points;
		$user->save();

		return response()->json([
			'success' => true,
			'comment' => $comment->toArray(),
			'user' => $user->toArray()
		], 200);
	}

	public function read_comment() {
		if (isset($_GET['comment_id'])) {
			$comment = ContentComment::find($_GET['comment_id']);

			return response()->json([
				'success' => true,
				'comment' => $comment->toArray(),
				'content' => $comment->content()->toArray(),
				'replies' => $comment->replies()->toArray(),
				'user' => $comment->user()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a comment id.'
			], 200);
		}
	}

	public function delete_comment(Request $data) {
		$comment = ContentComment::find($data->comment_id);
		$comment->is_active = 0;
		$comment->save();

		return response()->json([
			'success' => true
		], 200);
	}

	public function create_comment_reply(Request $data) {
		$reply = new CommentReply;
		$reply->comment_id = $data->comment_id;
		$reply->user_id = $data->user_id;
		$reply->comment = $data->comment;
		$reply->save();

		return response()->json([
			'success' => true,
			'reply' => $reply->toArray()
		], 200);
	}

	public function read_comment_reply() {
		if (isset($_GET['reply_id'])) {
			$reply = CommentReply::find($_GET['reply_id']);

			return response()->json([
				'success' => true,
				'reply' => $reply->toArray(),
				'user' => $reply->user()->toArray(),
				'comment' => $reply->comment()->toArray()
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify a reply id.'
			], 200);
		}
	}

	public function delete_comment_reply(Request $data) {
		$reply = CommentReply::find($data->reply_id);
		$reply->is_active = 0;
		$reply->save();

		return response()->json([
			'success' => true
		], 200);
	}

	/* --------------------- *\
	|  2. Get Functions       |
	\* --------------------- */

	public function get_comments() {
		if (isset($_GET['content_id'])) {
			$comments = ContentComment::where('content_id', $_GET['content_id'])->get();

			$return_array = array();
			foreach($comments as $comment) {
				$temp_array = array();
				$temp_array['comment'] = $comment->toArray();
				$temp_array['user'] = $comment->user()->toArray();
				$temp_array['content'] = $comment->content()->toArray();

				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'comments' => $return_array
			], 200);
		} else if (isset($_GET['user_id'])) {
			$comments = ContentComment::where('user_id', $_GET['user_id'])->get();

			$return_array = array();
			foreach($comments as $comment) {
				$temp_array = array();
				$temp_array['comment'] = $comment->toArray();
				$temp_array['user'] = $comment->user()->toArray();
				$temp_array['content'] = $comment->content()->toArray();

				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'comments' => $return_array
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify either a content id or user id.'
			], 200);
		}
	}

	public function get_comment_replies() {
		if (isset($_GET['comment_id'])) {
			$replies = CommentReply::where('comment_id', $_GET['comment_id'])->get();

			$return_array = array();
			foreach($replies as $reply) {
				$temp_array = array();
				$temp_array['reply'] = $reply->toArray();
				$temp_array['comment'] = $reply->comment()->toArray();
				$temp_array['user'] = $reply->user()->toArray();
				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'replies' => $return_array
			], 200);
		} else if (isset($_GET['user_id'])) {
			$replies = CommentReply::where('user_id', $_GET['user_id'])->get();

			$return_array = array();
			foreach($replies as $reply) {
				$temp_array = array();
				$temp_array['reply'] = $reply->toArray();
				$temp_array['comment'] = $reply->comment()->toArray();
				$temp_array['user'] = $reply->user()->toArray();
				array_push($return_array, $temp_array);
			}

			return response()->json([
				'success' => true,
				'replies' => $return_array
			], 200);
		} else {
			return response()->json([
				'success' => false,
				'error' => 'Please specify either a comment id or user id.'
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
