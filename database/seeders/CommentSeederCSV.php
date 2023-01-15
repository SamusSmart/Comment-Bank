<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentSeederCSV extends Seeder
{
    public function run()
    {
        Comment::truncate();

        $info = fopen(base_path("database/data/CommentInfo.csv"), "r");

        $dataRow = true;
        while (($data = fgetcsv($info, 4000, "|")) !== FALSE) {
            if (!$dataRow) {
                Comment::create([
                    'comment_id' => $data['0'],
                    'comment_name' => $data['1'],
                    'forename' => $data['2'],
                    'surname' => $data['3'],
                    'email' => $data['4'],
                    'validated' => $data['5'],
                ]);
            }
            $dataRow = false;
        }

        fclose($info);
    }
}