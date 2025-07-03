<?php

namespace App\Mail;

use App\Models\Post;
use App\Models\Suscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewBlogPostNotification extends Mailable
{
    use Queueable, SerializesModels;

    public Post $post;
    public $token = null;

    public function __construct(Post $post, $token = null)
    {
        $this->post = $post;
        $this->token = $token;
    }

    public function build()
    {
        logger('post: '.$this->post);

        return $this->subject('Nuevo artículo en el blog: ' . $this->post->title)
            ->markdown('emails.blog.new-post', [
                'post' => $this->post,
                'token' => $this->token,
            ]);
    }
}

