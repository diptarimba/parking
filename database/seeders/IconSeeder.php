<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;

class IconSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'icons';
        $this->csv_delimiter = ',';
		$this->filename = base_path().'/database/dataseeder/icon.csv';
        $this->mapping = [
            0 => 'code',
            1 => 'title'
        ];
        $this->should_trim = true;
	}

	public function run()
	{
		parent::run();
	}
}
