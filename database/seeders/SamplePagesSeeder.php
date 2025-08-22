<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Page;
use Illuminate\Support\Str;

class SamplePagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            ['Home','Welcome to our website','This is a public home page.'],
            ['About','About us','We are awesome.'],
            ['Contact','Contact us','Feel free to reach out.'],
        ];
        foreach ($pages as [$title,$excerpt,$content]) {
            Page::updateOrCreate(
                ['slug' => Str::slug($title)],
                compact('title','excerpt','content') + ['is_published' => true]
            );
        }
    }
}