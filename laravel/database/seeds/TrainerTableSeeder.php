<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class TrainerTableSeeder extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'trainer';
		$this->csv_delimiter = ';';
		$this->filename = base_path().'/database/seeds/csv/trainer.csv';
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
