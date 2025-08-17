<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{User, Account, Category, Counterparty, Transaction, Obligation, Setting};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'demo@example.com'],
            ['name' => 'Demo User', 'password' => Hash::make('password')]
        );

        // Settings
        Setting::updateOrCreate(['user_id' => $user->id], ['default_currency' => 'EUR', 'dark_mode' => false, 'week_start' => 1]);

        $cash = Account::create(['user_id' => $user->id, 'name' => 'Cash', 'type' => 'cash', 'currency' => 'EUR']);
        $bank = Account::create(['user_id' => $user->id, 'name' => 'Bank', 'type' => 'bank', 'currency' => 'EUR']);

        $incCats = collect(['Salary','Bonus','Interest'])->map(fn($n) => Category::create(['user_id'=>$user->id,'type'=>'income','name'=>$n]));
        $expCats = collect(['Food','Rent','Transport','Utilities'])->map(fn($n) => Category::create(['user_id'=>$user->id,'type'=>'expense','name'=>$n]));

        $alice = Counterparty::create(['user_id'=>$user->id,'name'=>'Alice','kind'=>'person']);
        $acme = Counterparty::create(['user_id'=>$user->id,'name'=>'ACME Inc','kind'=>'business']);

        // Random transactions for last 60 days
        for ($i=0; $i<120; $i++) {
            $date = now()->subDays(rand(0, 60))->setTime(rand(8,20), rand(0,59));
            if (rand(0,1)) {
                Transaction::create([
                    'user_id' => $user->id,
                    'account_id' => $bank->id,
                    'type' => 'income',
                    'amount' => rand(500, 3000),
                    'occurred_at' => $date,
                    'category_id' => $incCats->random()->id,
                    'counterparty_id' => rand(0,1)?$acme->id:null,
                ]);
            } else {
                Transaction::create([
                    'user_id' => $user->id,
                    'account_id' => rand(0,1)?$cash->id:$bank->id,
                    'type' => 'expense',
                    'amount' => rand(5, 120),
                    'occurred_at' => $date,
                    'category_id' => $expCats->random()->id,
                    'counterparty_id' => rand(0,1)?$alice->id:null,
                ]);
            }
        }

        // Obligations
        Obligation::create([
            'user_id' => $user->id,
            'counterparty_id' => $alice->id,
            'direction' => 'i_owe',
            'principal_amount' => 200,
            'currency' => 'EUR',
            'purpose' => 'Dinner split',
        ]);
        Obligation::create([
            'user_id' => $user->id,
            'counterparty_id' => $acme->id,
            'direction' => 'owed_to_me',
            'principal_amount' => 150,
            'currency' => 'EUR',
            'purpose' => 'Refund',
        ]);
    }
}
