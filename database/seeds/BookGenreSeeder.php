<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookGenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('book_genre')->truncate();
        DB::unprepared("INSERT INTO `book_genre` (`genre_id`, `name`, `image_url`, `status`, `created_at`, `updated_at`) VALUES
        (5, 'Fantasy', 'fantasy.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (6, 'Action and Adventure', 'adventure.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (7, 'Romance', 'romance.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (10, 'Crime/Mystery', 'mystery.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (11, 'Horror', 'horror.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (12, 'Thriller', 'thriller.png', 'AC', '2020-07-19 13:24:36', NULL),
        (13, 'Paranormal', 'paranormal.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (14, 'Historical Fiction', 'historical.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (15, 'Science Fiction', 'science-fiction.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (17, 'Cooking', 'cooking.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (18, 'Art', 'art-wallpaper.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (22, 'Health', 'Health.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (23, 'History', 'history-theme.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (28, 'Non-Fictional', 'nonfictional.jpg', 'AC', '2020-07-19 13:24:36', NULL),
        (33, 'Comedy', '1595750998.jpeg', 'AC', '2020-07-26 08:09:58', NULL),
        (34, 'Religious/Inspiration', '1595752660.png', 'AC', '2020-07-26 08:37:40', NULL),
        (44, 'Comedy', '1597569515.jpg', 'AC', '2020-08-16 09:18:35', NULL),
        (45, 'Romance111111', '1597569872.jpg', 'AC', '2020-08-16 09:24:32', NULL),
        (46, 'tst101', '1597570278.jpg', 'AC', '2020-08-16 09:31:18', NULL),
        (47, 'dddd', '1597570352.jpg', 'AC', '2020-08-16 09:32:32', NULL),
        (48, 'Last111111', '1597570642.jpg', 'AC', '2020-08-16 09:37:22', NULL),
        (49, 'CalvinAdded', '1597584034.jpg', 'AC', '2020-08-16 13:20:34', NULL);");
    }
}
