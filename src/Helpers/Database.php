<?php

namespace KBNT\Framework\Helpers;

class Database {
	/**
	 * Create DB
	 * @param string $table_name Table name to create.
	 * @param string $columns Columns to create (without id column)
	 * @see https://codex.wordpress.org/Creating_Tables_with_Plugins
	 * @return array
	 */
	public function createDb( $table_name, $columns )
	{
		global $wpdb;

		$table_name = $wpdb->prefix . $table_name;
		$charset_collate = $wpdb->get_charset_collate();

		// Make sure that the columns ends with comma.
		$columns = substr($columns, -1, 1) === ',' ? $columns : $columns . ',';

		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			$columns
			PRIMARY KEY (id)
		) $charset_collate;";

		include_once ABSPATH . 'wp-admin/includes/upgrade.php';
		return \dbDelta($sql);

	}

	/**
	 * Downloadable csv on the fly and delete file
	 * @param string $table_name Table name
	 * @param array $headers CSV headers & table columns
	 * @param string|null $filename Desired filename
	 * @return never
	 */
	public function downloadCsvFromTable($table_name, $headers, $filename = null) {
		$path = $this->getCsvFromTable($table_name, $headers, $filename);
		$exploded = \explode('/',$path);
		$download_filename = \array_pop($exploded);
		// download csv file
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=" . $download_filename);
		header("Content-Type: application/csv;");
		readfile($path);
		// delete the file.
		unlink($path);
		exit;
	}

	/**
	 * Retrieve data and save them as csv to uploads directory
	 * @see https://www.phpkida.com/export-database-table-to-csv-in-wordpress/
	 * @param string $table_name Table name
	 * @param array $headers CSV headers & table columns
	 * @param string|null $filename Desired filename
	 * @return string
	 */
	public function getCsvFromTable( $table_name, $headers, $filename = null) {

		global $wpdb;

		$table_name = $wpdb->prefix . $table_name;
		$filename = ($filename ? $filename : $table_name) . "_". date("Ymd-His") . ".csv";
		$columns = \implode(",", $headers);
		$rows = $wpdb->get_results("SELECT $columns FROM $table_name ORDER BY `id` DESC");

		$path = WP_CONTENT_DIR . '/uploads/' . $filename;

		// Clean object
		ob_end_clean();

		// Open file
		$file = fopen($path, "w");

		// Add header
		$array = [];
		foreach ($headers as $header) {
			$array[$header] = $header;
		}
		fputcsv($file, $array);

		// loop for insert data into CSV file
		foreach ($rows as $row) {
			$array = [];
			foreach( $headers as $header ) {
				$array[$header] = $row->{$header};
			}
			fputcsv($file, $array);
		}

		// Close file
		fclose($file);

		return $path;

	}
}
