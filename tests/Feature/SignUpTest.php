<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SignUpTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function signup_page_contains_signup_component()
    {
        $this->get('/signup')->assertSeeLivewire('auth.signup');
    }

    /** @test */
    function can_signup() 
    {

        $email = 'mail@mail.com';

        // Is user has signed up and redirected
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('signup')
        ->assertRedirect('/');

        // Is user has created in db
        $this->assertTrue(User::whereEmail('mail@mail.com')->exists());

        // Is user has logged in
        $this->assertEquals($email, auth()->user()->email);
    }

    /** @test */
    function email_is_required() 
    {

        $email = '';

        // Is email input has error
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('signup')
        ->assertHasErrors(['email' => 'required']);
    }

    /** @test */
    function email_is_valid_email() 
    {

        $email = 'mail';

        // Is email is valid email
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('signup')
        ->assertHasErrors(['email' => 'email']);
    }

    /** @test */
    function email_hasnt_been_taken_already() 
    {

        $email = 'mail@mail.com';

        User::create([
            'email' => $email,
            'password' => Hash::make('secret'),
        ]);

        // Is email hasn't been taken already
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', 'secret')
        ->set('passwordConfirmation', 'secret')
        ->call('signup')
        ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function see_email_hasnt_already_been_taken_validation_message_as_user_types() 
    {

        $email = 'mail@mail.com';
        $newEmail = 'mail2@mail.com';

        User::create([
            'email' => $email,
            'password' => Hash::make('secret'),
        ]);

        // Is email hasn't been taken already
        Livewire::test('auth.signup')
        ->set('email', $newEmail)
        ->assertHasNoErrors()
        ->set('email', $email)
        ->assertHasErrors(['email' => 'unique']);
    }

    /** @test */
    function password_is_required() 
    {

        $email = 'mail@mail.com';
        $password = '';

        // Is email input has error
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', $password)
        ->set('passwordConfirmation', $password)
        ->call('signup')
        ->assertHasErrors(['password' => 'required']);
    }

    /** @test */
    function password_is_minimum_of_6_characters() 
    {

        $email = 'mail@mail.com';
        $password = '123';

        // Is email input has error
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', $password)
        ->set('passwordConfirmation', $password)
        ->call('signup')
        ->assertHasErrors(['password' => 'min']);
    }

    /** @test */
    function password_matches_password_confirmation() 
    {

        $email = 'mail@mail.com';
        $password = 'secret';
        $passwordConfirmation = 'nonSecret';

        // Is email input has error
        Livewire::test('auth.signup')
        ->set('email', $email)
        ->set('password', $password)
        ->set('passwordConfirmation', $passwordConfirmation)
        ->call('signup')
        ->assertHasErrors(['password' => 'same']);
    }
}
