<?php

use App\Models\{User, Account};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('prevents accessing another users account', function () {
    $userA = User::factory()->create();
    $userB = User::factory()->create();

    $this->actingAs($userA);
    $accountA = Account::create(['name'=>'A','type'=>'cash','currency'=>'EUR']);

    $this->actingAs($userB);
    $this->get(route('accounts.show', $accountA))->assertNotFound();
});


