### `php artisan install:api`

### `php artisan make:mail MailNotify --markdown=emailTemplate`

### `php artisan make:controller MailNotifyController`

### Avoid Mental Mapping

Explicit is better than implicit.

**Good:**

```php
Route::post('user/send', [MailNotifyController::class, 'index']);
```
