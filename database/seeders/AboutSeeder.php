<?php

namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        About::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'subtitle' => 'Bring your dream into Reality',
            'image' => '1708111815-Lunar Oversea - Landscape.png',
            'description' => 'Lunar Overseas is a pioneer organization in overseas employment. The organization is recognized by various overseas companies and a large number of workers who have been successfully placed in different companies all over the globe.',
            'content' => 'Lunar Overseas is a pioneer organization in overseas employment. The organization is recognized by various overseas companies and a large number of workers who have been successfully placed in different companies all over the globe. With quality credentials and our trustworthy service guides we excel workers to reach their best possible professional heights based on their  merit and capacity.Facilitating best working opportunities in the prestigious companies abroad, we rightly\r\nset the  goals for aspiring workers. We have a large number of workers to our\r\ncredit, who have been placed in top companies all over the world.\r\nCommitted to the objectives of integrity and excellence, Lunar Overseas is an acknowledged leader in overseas manpower consultancy in Nepal complementing the aptitudes of human resource, we recommend nothing less than the best in their pursuit.\r\nRelieving you of uncertainties and confusion regarding the career options, we can serve you\r\nby providing the best counseling and guidance to help you make the right decision.\r\n\r\n➢ Lunar Oversea is an organization established with an aim to\r\nprovide an outstanding support to aspiring workers, assisting in expanding\r\ntheir profession to new horizons.\r\n➢ Sharing a friendly relation with all the workers and guiding them to determine the\r\nmost suitable works and companies in Saudi Arabia, Kuwait, Japan, Malaysia, Bahrain and also Europe.\r\n➢ Run by qualified and experiences professionals who have direct links with overseas companies. ',


        ]);
        // About::factory()->count(1)->create();
    }
}
