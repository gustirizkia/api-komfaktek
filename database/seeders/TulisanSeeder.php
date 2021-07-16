<?php

namespace Database\Seeders;

use App\Models\Tulisan;
use Illuminate\Database\Seeder;

class TulisanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); //faker library
        for ($i = 1; $i < 10; $i++) {
            if ($i % 2 < 1) {
                Tulisan::create([
                    'user_id' => 1,
                    'kategori_tulisan_id' => 1,
                    'judul' => 'isi judul 1',
                    'teks' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto, eligendi facilis tempora fuga accusamus cumque maxime et placeat ab impedit repellendus voluptatum voluptatibus voluptate fugit praesentium magni atque fugiat quos assumenda esse! Nisi a cum, explicabo, culpa voluptates perferendis odit minima eius modi harum commodi id? Sequi quas veritatis ratione eaque quia ea modi libero odio laudantium perferendis ullam eum in ipsam dolorum voluptates a deserunt, sed labore nisi aspernatur omnis ut doloribus doloremque. Necessitatibus quod, nisi officia, officiis eveniet alias esse quibusdam commodi ipsum saepe est, aliquam harum tempora dignissimos. Corporis quaerat non incidunt voluptatibus, cupiditate blanditiis ullam perspiciatis dolore consequatur odio dignissimos dicta eveniet officia asperiores. Facilis maxime ea consequatur necessitatibus modi sunt cum distinctio possimus assumenda doloribus laborum tempora, reprehenderit ad suscipit veniam! Obcaecati commodi qui accusamus assumenda nam unde deserunt a harum quae perferendis odit doloremque aspernatur dolor voluptatem quia praesentium expedita perspiciatis explicabo deleniti ipsam ullam ipsa, inventore corporis? Id mollitia dolorum at numquam deserunt laudantium, nemo eveniet facilis cupiditate soluta laboriosam quae aut quam odio labore amet quibusdam. Aspernatur est dolore quibusdam harum, necessitatibus suscipit! Doloremque soluta voluptates ad necessitatibus placeat dignissimos obcaecati porro laboriosam culpa sequi, cupiditate sit a nemo aliquam est nihil.',
                ]);
            } else {
                Tulisan::create([
                    'user_id' => 1,
                    'kategori_tulisan_id' => 2,
                    'judul' => 'isi judul 1',
                    'teks' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Architecto, eligendi facilis tempora fuga accusamus cumque maxime et placeat ab impedit repellendus voluptatum voluptatibus voluptate fugit praesentium magni atque fugiat quos assumenda esse! Nisi a cum, explicabo, culpa voluptates perferendis odit minima eius modi harum commodi id? Sequi quas veritatis ratione eaque quia ea modi libero odio laudantium perferendis ullam eum in ipsam dolorum voluptates a deserunt, sed labore nisi aspernatur omnis ut doloribus doloremque. Necessitatibus quod, nisi officia, officiis eveniet alias esse quibusdam commodi ipsum saepe est, aliquam harum tempora dignissimos. Corporis quaerat non incidunt voluptatibus, cupiditate blanditiis ullam perspiciatis dolore consequatur odio dignissimos dicta eveniet officia asperiores. Facilis maxime ea consequatur necessitatibus modi sunt cum distinctio possimus assumenda doloribus laborum tempora, reprehenderit ad suscipit veniam! Obcaecati commodi qui accusamus assumenda nam unde deserunt a harum quae perferendis odit doloremque aspernatur dolor voluptatem quia praesentium expedita perspiciatis explicabo deleniti ipsam ullam ipsa, inventore corporis? Id mollitia dolorum at numquam deserunt laudantium, nemo eveniet facilis cupiditate soluta laboriosam quae aut quam odio labore amet quibusdam. Aspernatur est dolore quibusdam harum, necessitatibus suscipit! Doloremque soluta voluptates ad necessitatibus placeat dignissimos obcaecati porro laboriosam culpa sequi, cupiditate sit a nemo aliquam est nihil.',
                ]);
            }
        }
    }
}
