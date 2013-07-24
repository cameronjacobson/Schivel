<?php

require_once(dirname(__DIR__).'/vendor/autoload.php');

use Schivel\Schivel;
use Phreezer\Storage\CouchDB;

$couch = new Schivel(new CouchDB([
	'database'=>'test'
]));

$car = new car();
$car->make = 'Ford';
$car->model = 'Explorer';
$car->owner = 'me';

$uuid = $couch->store($car);

$car2 = new car();
$car2->make = 'VW';
$car2->model = 'Jetta';
$car2->owner = 'me';

$uuid2 = $couch->store($car2);

var_dump($couch->fetchDocByKey('car_by_uuid', $uuid));
var_dump($couch->fetchDocstateByKey('car_by_uuid', $uuid));
var_dump($couch->fetchValueByKey('car_by_uuid', $uuid));
var_dump($couch->fetchIdByKey('car_by_uuid', $uuid));
var_dump($couch->fetchObjectByKey('car_by_uuid', $uuid));
var_dump($couch->fetchJsonByKey('car_by_uuid', $uuid));
var_dump($couch->isDuplicate('car_by_owner', $car->owner));

var_dump($couch->page(1,1)->fetchDocstateByKey('car_by_owner', $car->owner));
var_dump($couch->page(2,1)->fetchDocstateByKey('car_by_owner', $car->owner));

$car->_delete = true;
$couch->store($car);
$car2->_delete = true;
$couch->store($car2);

class car
{
	public $make;
	public $model;
	public function __construct(){
		
	}
}

function E($val){
	error_log(var_export($val,true));
}