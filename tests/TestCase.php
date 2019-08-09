<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function signIn($user = null)
    {
        // If we have usere -use it. Othwerwise create new one.
        $user = $user ?: factory('App\User')->create();

        $this->actingAs($user);

        return $user;
    }
}