<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Bank;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // First, clear existing to avoid duplication if it runs multiple times
        Schema::disableForeignKeyConstraints();
        User::query()->delete();
        Book::query()->delete();
        Bank::query()->delete();
        Schema::enableForeignKeyConstraints();

        // --- 1. Seed Simulated Banks ---
        $banks = ['Chase Bank', 'Bank of America', 'Wells Fargo', 'Citibank'];
        foreach ($banks as $bankName) {
            Bank::create(['name' => $bankName]);
        }

        // --- 2. Seed Authors (and Customers) ---
        $authorOne = User::create([
            'first_name' => 'George',
            'last_name' => 'Orwell',
            'email' => 'george@authors.com',
            'phone' => '555-0101',
            'role' => 'Author',
            'password' => Hash::make('password123'),
        ]);

        $authorTwo = User::create([
            'first_name' => 'Agatha',
            'last_name' => 'Christie',
            'email' => 'agatha@authors.com',
            'phone' => '555-0202',
            'role' => 'Author',
            'password' => Hash::make('password123'),
        ]);

        $customer = User::create([
            'first_name' => 'Jane',
            'last_name' => 'Doe',
            'email' => 'jane@example.com',
            'phone' => '555-0303',
            'role' => 'Customer',
            'password' => Hash::make('password123'),
        ]);

        // --- 3. Seed Books linked to Authors ---
        Book::create([
            'author_id' => $authorOne->id,
            'title' => '1984',
            'genre' => 'Fiction',
            'price' => 14.99,
            'isbn' => '978-0451524935',
            'description' => 'Among the seminal texts of the 20th century, Nineteen Eighty-Four is a rare work that grows more haunting as its futuristic purgatory becomes more real.',
        ]);

        Book::create([
            'author_id' => $authorOne->id,
            'title' => 'Animal Farm',
            'genre' => 'Fiction',
            'price' => 9.99,
            'isbn' => '978-0451526342',
            'description' => 'A farm is taken over by its overworked, mistreated animals. With flaming idealism and stirring slogans, they set out to create a paradise of progress, justice, and equality.',
        ]);

        Book::create([
            'author_id' => $authorTwo->id,
            'title' => 'Murder on the Orient Express',
            'genre' => 'Mystery',
            'price' => 12.50,
            'isbn' => '978-0062073501',
            'description' => 'Just after midnight, the famous Orient Express is stopped in its tracks by a snowdrift. By morning, the millionaire Samuel Edward Ratchett lies dead in his compartment.',
        ]);

        Book::create([
            'author_id' => $authorTwo->id,
            'title' => 'And Then There Were None',
            'genre' => 'Mystery',
            'price' => 11.20,
            'isbn' => '978-0062073488',
            'description' => 'Ten people, each with something to hide and something to fear, are invited to an isolated mansion on Indian Island by a host who, surprisingly, fails to appear.',
        ]);

        Book::create([
            'author_id' => $authorTwo->id,
            'title' => 'Death on the Nile',
            'genre' => 'Mystery',
            'price' => 13.99,
            'isbn' => '978-0062073556',
            'description' => 'The tranquility of a luxury cruiser on the Nile is shattered by the discovery that a passenger has been shot through the head.',
        ]);
        
        $this->command->info('Database seeded successfully with Authors, Books, and Banks!');
    }
}
