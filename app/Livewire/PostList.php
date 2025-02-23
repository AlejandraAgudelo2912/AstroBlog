<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    public $showTrashed = false; // Alternar entre posts normales y eliminados

    public function restore($postId)
    {
        $post = Post::onlyTrashed()->findOrFail($postId);
        $post->restore();
        session()->flash('success', 'Post restaurado correctamente.');
    }

    public function forceDelete($postId)
    {
        $post = Post::onlyTrashed()->findOrFail($postId);
        $post->forceDelete();
        session()->flash('success', 'Post eliminado permanentemente.');
    }

    public function delete($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();
        session()->flash('success', 'Post eliminado.');
    }

    public function render()
    {
        $posts = Post::withTrashed()->with('user')->paginate(10);

        return view('livewire.post-list', compact('posts'));
    }
}
