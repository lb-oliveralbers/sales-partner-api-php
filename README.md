# Sales Partner API Sample PHP Client

This is a sample PHP client for the Sales Partner API. It demonstrates how to authenticate with the Sales Partner API and make a simple request.

This code is **UNSUPPORTED** and is provided as a reference only.

## How to use
Add a .env file to the root of the project with the following content:

```
SALES_PARTNER_CLIENT_ID=YOUR CLIENT ID
SALES_PARTNER_CLIENT_SECRET=YOUR CLIENT SECRET
SALES_PARTNER_UPLOAD_REALM=YOUR UPLOAD REALM
```

Then, after running a ```composer install```, you can execute sample.php using your PHP interpreter:
```php sample.php```

You should then see the client logging in and submitting a sample order, uploading a sample PDF file and then checking the status again.