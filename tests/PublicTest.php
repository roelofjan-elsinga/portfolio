<?php

namespace Tests;

use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Main\Mail\ContactMail;

class PublicTest extends TestCase
{
    public function test_atom_feed_can_be_viewed()
    {
        $this
            ->get(route('feed'))
            ->assertHeader('Content-Type', 'text/xml')
            ->assertOk();
    }

    public function test_rss_feed_can_be_viewed()
    {
        $this
            ->get(route('feed.rss'))
            ->assertHeader('Content-Type', 'text/xml')
            ->assertOk();
    }

    public function test_contact_email_can_be_sent()
    {
        Mail::fake();

        $this
            ->from(route('home'))
            ->post(route('contact'), [
                'name' => 'Test',
                'email' => 'test@example.com',
                'message' => 'a test'
            ])
            ->assertRedirect(route('home'))
            ->assertSessionHas('contact_success', true);

        Mail::assertSent(ContactMail::class, function ($mail) {
            return $mail->hasTo('contact@roelofjanelsinga.com');
        });
    }

    public function test_contact_mail_uses_correct_email_template()
    {
        $mailable = new ContactMail('test', 'test@example.com', 'a test');

        $this->assertSame('emails.contact', $mailable->build()->view);
    }
}
