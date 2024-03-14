### `.env`

```php
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=<Your Email Here>
MAIL_PASSWORD=<Your App Password Here>
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"
```

---

### `php artisan install:api`

### api.php

```php
Route::post('user/send', [MailNotifyController::class, 'index']);
```

### `php artisan make:mail MailNotify --markdown=emailTemplate`

```php
<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $name, $email;

    /**
     * Create a new message instance.
     */
    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'My Subject',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emailTemplate',
            // You can use normal blade file instead of markdown file
            // view: 'emailTemplate',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}

```

```php
<x-mail::message>
# Introduction

The body of your message.

{{ $name }}

{{ $email }}

<x-mail::button :url="'https://www.google.com/'">
Button
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>

```

### `php artisan make:controller MailNotifyController`

```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MailNotify;
use Mail;

class MailNotifyController extends Controller
{
    public function index(Request $request)
    {
        $name = $request->name;
        $email = $request->email;

        // You can add ststic email for ex: Mail::to('muh@mail.com')...
        Mail::to($email)->send(new MailNotify($name, $email));
    }
}

```
