<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class DownloadTableSeeder extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'downloads';
		$this->csv_delimiter = ';';
		$this->filename = base_path().'/database/seeds/csv/download.csv';
	}

	public function run()
	{
		// Recommended when importing larger CSVs
		DB::disableQueryLog();

		// Uncomment the below to wipe the table clean before populating
		DB::table($this->table)->truncate();

		parent::run();
	}
}
