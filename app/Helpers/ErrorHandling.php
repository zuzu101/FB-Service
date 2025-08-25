<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\App;

class ErrorHandling {

    public static function environmentErrorHandling ($message) {
        $errorMessage = "";

        App::environment('local') ? $errorMessage = $message : $errorMessage = 'Terdapat kesalahan pada sistem, Mohon untuk memberitahu admin segera.';

        throw new Exception($errorMessage);
    }

}
