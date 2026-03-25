<?php
namespace App\Services\CMS;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;

class PostService
{
    /** Create a new post draft. */
    public function create(array $data, User $author): Post
    {
        return Post::create([
            ...$data,
            'user_id' => $author->id,
            'slug'    => Str::slug($data['title']),
            'status'  => $data['status'] ?? 'draft',
        ]);
    }

    /** Publish a post immediately. */
    public function publish(Post $post): Post
    {
        $post->update(['status' => 'published', 'published_at' => now()]);
        return $post->fresh();
    }

    /** Update an existing post. */
    public function update(Post $post, array $data): Post
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        $post->update($data);
        return $post->fresh();
    }
}
