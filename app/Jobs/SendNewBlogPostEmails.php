<?php

namespace App\Jobs;

use App\Mail\NewBlogPostNotification;
use App\Models\NewsletterSubscriber;
use App\Models\Post;
use App\Models\Suscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendNewBlogPostEmails implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function handle(): void
    {
        $subscribers = Suscriber::whereNotNull('email')
            ->where('email', '!=', '')
            ->get(['email', 'unsubscribe_token']);

            logger('post: '.$this->post);
            logger('suscriptior: '.$subscribers);
            $post = $this->post;

        Suscriber::chunk(100, function ($subscribers) use ($post) {
            foreach ($subscribers as $subscriber) {
                if (!$subscriber->email) {
                    logger('Suscriptor sin email, se omite.');
                    continue;
                }

                logger('Enviando correo a: ' . $subscriber->email);
                logger('Enviando post: ' . $this->post);
                Mail::to($subscriber->email)->queue(new NewBlogPostNotification($post, $subscriber->unsubscribe_token));
            }
        });

    }
}
