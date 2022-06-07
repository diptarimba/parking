<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Flynsarmy\CsvSeeder\CsvSeeder;
use Illuminate\Database\Seeder;

class ZmdiSeeder extends CsvSeeder
{
    public function __construct()
	{
		$this->table = 'zmdis';
        $this->csv_delimiter = ',';
		$this->filename = base_path().'/database/dataseeder/zmdi.csv';
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

