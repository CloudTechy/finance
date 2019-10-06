<?php
return [
    // frontend URL
    'url' => 'http://localhost:8000',
    // path to my frontend page with query param queryURL(temporarySignedRoute URL)
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/confirm-registration?queryURL='),
    'admin_email' => 'davidrobinson5616@yahoo.com',
    'admin_name' => 'BFIN Notification',
];
