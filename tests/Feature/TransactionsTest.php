<?php

use App\Models\{User, Account, Category};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('creates income transaction', function () {
    $user = User::factory()->create();
    $this->actingAs($user);
    $account = Account::create(['name'=>'Wallet','type'=>'cash','currency'=>'EUR']);
    $cat = Category::create(['type'=>'income','name'=>'Salary']);

    $resp = $this->post(route('transactions.store'), [
        'type' => 'income',
        'account_id' => $account->id,
        'amount' => 100,
        'occurred_at' => now()->format('Y-m-d H:i:s'),
        'category_id' => $cat->id,
    ]);
    $resp->assertRedirect(route('transactions.index'));
    $this->assertDatabaseCount('transactions', 1);
});


