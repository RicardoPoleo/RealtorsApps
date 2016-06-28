<?php
/**
 * Streamdate Fixture
 */
class StreamdateFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'properties_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'stream_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null, 'key' => 'primary'),
		'capacity' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => array('properties_id', 'stream_datetime'), 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'properties_id' => 1,
			'stream_datetime' => '2016-02-29 10:24:47',
			'capacity' => 1
		),
	);

}
