<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePostPDF($postId)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($postId);

        $pdf = Pdf::loadView('pdfs.post', compact('post'));

        return $pdf->download('post_' . $post->id . '.pdf');
    }
}
