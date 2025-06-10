<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
public function test_user_bisa_login()
{
    $user = User::factory()->create([
        'email' => 'admin3@example.com',
        'password' => bcrypt('password'),
    ]);

    $this->browse(function (Browser $browser) use ($user) {
        $browser->visit('/login')
                ->waitFor('#email', 5)
                ->screenshot('login-page') // cek apakah form muncul
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Log In')
                ->waitForLocation('/', 5)
                ->assertPathIs('/')
                ->assertSee('List Slip Gaji');
    });
}

}
