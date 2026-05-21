<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@perpus.com',
            'password' => Hash::make('password'),
            'role'     => 'admin',
            'city'     => 'Jakarta',
            'phone'    => '08123456789',
        ]);

        // Petugas
        User::create([
            'name'     => 'Petugas Perpustakaan',
            'username' => 'petugas',
            'email'    => 'petugas@perpus.com',
            'password' => Hash::make('password'),
            'role'     => 'petugas',
            'city'     => 'Jakarta',
            'phone'    => '08129876543',
        ]);

        // User biasa
        User::create([
            'name'     => 'Budi Santoso',
            'username' => 'budi',
            'email'    => 'budi@example.com',
            'password' => Hash::make('password'),
            'role'     => 'user',
            'city'     => 'Jakarta',
            'phone'    => '08111222333',
        ]);

        // Kategori
        $categories = [
            ['name' => 'Fiksi', 'slug' => 'fiksi', 'icon' => '📖'],
            ['name' => 'Non-Fiksi', 'slug' => 'non-fiksi', 'icon' => '📚'],
            ['name' => 'Sains & Teknologi', 'slug' => 'sains-teknologi', 'icon' => '🔬'],
            ['name' => 'Sejarah', 'slug' => 'sejarah', 'icon' => '🏛️'],
            ['name' => 'Pendidikan', 'slug' => 'pendidikan', 'icon' => '🎓'],
            ['name' => 'Novel', 'slug' => 'novel', 'icon' => '📕'],
            ['name' => 'Komik & Manga', 'slug' => 'komik-manga', 'icon' => '🎨'],
            ['name' => 'Biografi', 'slug' => 'biografi', 'icon' => '👤'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Buku sample
        $books = [
            [
                'category_id' => 1, 'title' => 'Laskar Pelangi', 'author' => 'Andrea Hirata',
                'publisher' => 'Bentang Pustaka', 'publish_date' => '2005-09-01',
                'isbn' => '9789793062792', 'pages' => 529, 'language' => 'Indonesia',
                'synopsis' => 'Novel tentang semangat anak-anak Belitung dalam mengejar impian.',
                'stock' => 3, 'width' => 13.5, 'height' => 20.5, 'weight' => 400,
            ],
            [
                'category_id' => 6, 'title' => 'Bumi Manusia', 'author' => 'Pramoedya Ananta Toer',
                'publisher' => 'Hasta Mitra', 'publish_date' => '1980-01-01',
                'isbn' => '9789799731234', 'pages' => 535, 'language' => 'Indonesia',
                'synopsis' => 'Kisah cinta Minke di masa penjajahan Belanda.',
                'stock' => 2, 'width' => 13.0, 'height' => 20.0, 'weight' => 450,
            ],
            [
                'category_id' => 3, 'title' => 'A Brief History of Time', 'author' => 'Stephen Hawking',
                'publisher' => 'Bantam Books', 'publish_date' => '1988-04-01',
                'isbn' => '9780553380163', 'pages' => 212, 'language' => 'Inggris',
                'synopsis' => 'Eksplorasi alam semesta dari big bang hingga lubang hitam.',
                'stock' => 1, 'width' => 15.0, 'height' => 22.0, 'weight' => 350,
            ],
        ];

        foreach ($books as $book) {
            Book::create($book);
        }
    }
}
