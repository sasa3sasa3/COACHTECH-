<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;
use App\Models\Tag;


class ContactSeeder extends Seeder
{
    public function run(): void
    {
        //contactsテーブルに20件のダミーデータを投入する。
        $contacts = Contact::factory()->count(20)->create();

        foreach ($contacts as $contact) {
            // タグをランダムに1〜3件取得する
            $tagCount = fake()->numberBetween(1, 3);

            $tags = Tag::inRandomOrder()
                ->take($tagCount)
                ->get();

            // ContactとTagを1件ずつ紐付ける
            foreach ($tags as $tag) {
                $contact->tags()->attach($tag->id);
            }
        }
    }
}
