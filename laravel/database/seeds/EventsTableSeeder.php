<?php

use Flynsarmy\CsvSeeder\CsvSeeder;

class EventsTableSeeder extends CsvSeeder {

	public function __construct()
	{
		$this->table = 'events';
		$this->csv_delimiter = ';';
		$this->filename = base_path().'/database/seeds/csv/events.csv';
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
