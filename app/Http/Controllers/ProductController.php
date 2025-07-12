<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $data = DB::table('products')->get();

        return view('welcome',["data"=>$data]); // or return a string / JSON
    }

    public function add_form(){
        return view('form'); // or return a string / JSON

    }
    public function save(Request $request){
        $request->validate([
        'date' => 'required|date',
        'status' => 'nullable|integer',
        'type' => 'nullable|string|max:50',
        'link' => 'nullable|url|max:2083',
        'title' => 'required|string|max:255',
        'content' => 'nullable|string',
        'category' => 'nullable|string|max:100',
        'author' => 'nullable|string|max:100',
        'features_media' => 'nullable|string|max:255',
        'comment_status' => 'nullable|integer',
        'ping_status' => 'nullable|integer',
        'format' => 'nullable|string|max:50',
        'template' => 'nullable|string|max:100',
        'slug' => 'required|string|max:256|unique:products,slug',
        ]);

        DB::table('products')->insert([
            'date' => $request->date,
            'status' => $request->status,
            'type' => $request->type,
            'link' => $request->link,
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'author' => $request->author,
            'features_media' => $request->features_media,
            'comment_status' => $request->comment_status,
            'ping_status' => $request->ping_status,
            'format' => $request->format,
            'template' => $request->template,
            'slug' => $request->slug,
        ]);

     return redirect()->back()->with('success', 'Product saved successfully!');
    }

    public function edit($id)
    {
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            return redirect()->back()->with('error', 'Product not found.');
        }

        return view('edit_form',["data"=>$product]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $request->validate([
            'date' => 'required|date',
            'status' => 'nullable|integer',
            'type' => 'nullable|string|max:50',
            'link' => 'nullable|url|max:2083',
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'category' => 'nullable|string|max:100',
            'author' => 'nullable|string|max:100',
            'features_media' => 'nullable|string|max:255',
            'comment_status' => 'nullable|integer',
            'ping_status' => 'nullable|integer',
            'format' => 'nullable|string|max:50',
            'template' => 'nullable|string|max:100',
            'slug' => "required|string|max:256|unique:products,slug,{$id}",
        ]);

        DB::table('products')->where('id', $id)->update([
            'date' => $request->date,
            'status' => $request->status,
            'type' => $request->type,
            'link' => $request->link,
            'title' => $request->title,
            'content' => $request->content,
            'category' => $request->category,
            'author' => $request->author,
            'features_media' => $request->features_media,
            'comment_status' => $request->comment_status,
            'ping_status' => $request->ping_status,
            'format' => $request->format,
            'template' => $request->template,
            'slug' => $request->slug,
        ]);

        return redirect()->back()->with('success', 'Product updated successfully!');
    }


    public function importPosts()
    {
        $response = Http::get('https://learn.circuit.rocks/wp-json/wp/v2/posts');

        if (!$response->ok()) {
            return response()->json(['error' => 'Failed to fetch data'], 500);
        }

        $posts = $response->json();

        foreach ($posts as $post) {
            DB::table('products')->updateOrInsert(
                ['slug' => $post['slug']], // prevent duplicates
                [
                    'date' => $post['date'],
                    'status' => $post['status'] ?? 'published',
                    'type' => $post['type'] ?? 'post',
                    'link' => $post['link'] ?? null,
                    'title' => $post['title']['rendered'] ?? 'Untitled',
                    'content' => $post['content']['rendered'] ?? '',
                    'category' => $post['category'] ?? '', // you may extract category via another API call if needed
                    'author' => 'wordpress',
                    'features_media' => '', // optional
                    'comment_status' => $post['comment_status'] ?? 0,
                    'ping_status' => $post['ping_status'] ?? 0,
                    'format' => $post['format'] ?? '',
                    'template' => '',
                    'slug' => $post['slug'],
                ]
            );
        }

        return response()->json(['success' => 'Products imported successfully!']);
    }


    public function delete(Request $request)
    {

        $deleted = DB::table('products')->where('id', $request->id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success', 'Product deleted successfully.');
        } else {
            return redirect()->back()->with('error', 'Product could not be deleted.');
        }
    }
}