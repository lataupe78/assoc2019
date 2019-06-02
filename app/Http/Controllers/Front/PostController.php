<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Section;
use Illuminate\Http\Request;

class PostController extends Controller
{
	public function index(Section $section){

		$posts = Post::published()
		->forSection($section)
		->orderBy('published_at', 'desc')
		->paginate(5);

		return view('front.posts.index', [
			'posts' => $posts,
			'section' => $section
		]);
	}


	public function show(Section $section, Post $post){
		$post = Post::published()
		->forSection($section)
		->where([ 'id' => $post->id ])
		->firstOrFail();


		$previous = Post::published()->forSection($section)
		->where('id', '<', $post->id)->orderBy('published_at', 'asc')->first();

		$next = Post::published()->forSection($section)
		->where('id', '>', $post->id)->orderBy('published_at', 'asc')->first();

		return view('front.posts.show', [
			'post' => $post,
			//'mediaItems' => $mediaItems,
			'section' => $section,
			'previous' => $previous,
			'next' => $next,
		]);
	}


}
