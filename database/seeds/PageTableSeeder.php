<?php

use Illuminate\Database\Seeder;
use Main\Models\Page;

class PageTableSeeder extends Seeder
{
    public function run()
    {
        Page::create(['name' => 'home', 'slug' => 'home', 'title' => 'Welcome', 'content' => 'I\'m Roelof, and this is my portfolio.', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);

        Page::create(['name' => 'work', 'slug' => 'work', 'title' => 'Work', 'content' => 'My previous work is displayed in this section. Hover over the images to get a summary of what the project was about.', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);

        Page::create(['name' => 'service', 'slug' => 'services', 'title' => 'Services', 'content' => 'Within web development there are several different aspects to the field, here are the ones I can help you out with.', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);

        Page::create(['name' => 'about', 'slug' => 'about', 'title' => 'About me', 'content' => 'I\'m Roelof Jan Elsinga (Roelof in short) and I\'m a 21 year old student from the Netherlands. While studying in the Netherlands is fun, I spend more time abroad to study and for an internship. I have studied in the United States and I\'m currently doing an internship in Curacao. These experiences have taught me a lot more than practical skills. They\'ve taught me how to work better with other people, especially people from other cultures. Learning about other cultures is a thing I really enjoy doing, because it helps me to better understand the world we live in.
Besides learning about other cultures, I love to work on web development projects such as this website. I enjoy making web systems, such as home improvement systems or registration systems of any sort. They really challenge me to find the most efficient way of creating web systems. I also really enjoy creating little web applications that are put to good use every once in a while, such as a lap counter for if you\'re running on a track.
    I hope you enjoy my work just as much as I do!', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);

        Page::create(['name' => 'contact', 'slug' => 'contact', 'title' => 'Contact', 'content' => 'Contact me for questions, requests, and comments!', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);

        Page::create(['name' => 'footer', 'slug' => 'footer', 'title' => 'This is the end!', 'content' => 'Thank you for your visit!', 'keywords' => 'roelof, jan, elsinga', 'description' => 'This is the homepage of Roelof Jan Elsinga', 'user_id' => 1, 'image_large' => '', 'image_small' => '']);
    }
}
