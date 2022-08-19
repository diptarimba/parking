<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Faq::factory()
        ->count(5)
        ->state(new Sequence([
            ['question' => 'Apa itu Smart Parking?', 'answer' => 'Smart Parking merupakan teknologi parkir berbasis web.'],
            ['question' => 'Mengapa harus menggunakan smart parking?', 'answer' => 'Smart parking membantu meningkatkan retribusi pendapatan parkir dengan menggunakan sistem monitoring.'],
            ['question' => 'Apa keunggulan utama smart parking?', 'answer' => 'Smart Parking papper less dengan metode pembayaran QRIS.'],
            ['question' => 'Dimana smart parking dapat digunakan?', 'answer' => 'Smart parking dapat dijumpai di Java Mall, Paragon Mall, Polines, dan Lawang Sewu.'],
            ['question' => 'Apa yang perlu dipersiapkan saat ingin parkir?', 'answer' => 'Siapkan handphone yang sudah tersambung dengan internet dan buka situs smart parking.'],
        ]))
        ->create();
    }
}
