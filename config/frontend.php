<?php
return [
    // frontend URL
    'url' => 'http://localhost:8000',
    // path to my frontend page with query param queryURL(temporarySignedRoute URL)
    'email_verify_url' => env('FRONTEND_EMAIL_VERIFY_URL', '/confirm-registration?queryURL='),
];
