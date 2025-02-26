
<?php

use Illuminate\Auth\AuthenticationException;

protected function unauthenticated($request, AuthenticationException $exception)
{
    return response()->json(['error' => 'Unauthenticated.'], 401);
}
