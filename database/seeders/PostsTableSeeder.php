<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name' => 'don',
            'email' => 'don@gmail.com',
            'password' => Hash::make('password')
        ]);
        $author2 = User::create([
            'name' => 'noob',
            'email' => 'noob@gmail.com',
            'password' => Hash::make('password')
        ]);


        $category1 = Category::create([
            'title' => 'News' 
        ]);
        $category2 = Category::create([
            'title' => 'Marketing' 
        ]);
        $category3 = Category::create([
            'title' => 'Partnership' 
        ]);
        $post1 = Post::create([
            'title'=>'Nepal',
            'description'=>'nepal is a beautiful country',
            'content'=>'heaven is myth but not nepal is for real',
            'category_id'=> $category1->id,
            'image' => 'posts/1.jpg',
            'user_id' => $author1->id
        ]);
        $post2 = Post::create([
            'title'=>'India',
            'description'=>'nepal is a beautiful country',
            'content'=>'heaven is myth but not nepal is for real',
            'category_id'=> $category2->id,
            'image' => 'posts/3.jpg',
            'user_id' => $author2->id

        ]);
        $post3 = Post::create([
            'title'=>'China',
            'description'=>'nepal is a beautiful country',
            'content'=>'heaven is myth but not nepal is for real',
            'category_id'=> $category3->id,
            'image' => 'posts/3.jpg',
            'user_id' => $author2->id

        ]);

        $tag1 = Tag::create([
            'title' => 'Job' 
        ]);
        $tag2 = Tag::create([
            'title' => 'Customers' 
        ]);
        $tag3 = Tag::create([
            'title' => 'Record' 
        ]);
        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag2->id,$tag3->id]);
        $post3->tags()->attach([$tag1->id,$tag3->id]);
    }
}
