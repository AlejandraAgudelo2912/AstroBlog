<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class PdfController extends Controller
{
    public function generatePostPDF($postId)
    {
        $post = Post::with(['user', 'comments'])->findOrFail($postId);

        $pdf = Pdf::loadView('pdfs.post', compact('post'));

        return $pdf->download('post_'.$post->id.'.pdf');
    }

    public function generateUsersReport()
    {
        $users = User::withCount(['posts', 'comments'])->get();

        $pdf = Pdf::loadView('pdfs.users', compact('users'));

        return $pdf->download('reporte_usuarios.pdf');
    }
}
