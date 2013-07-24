<?php

namespace Schivel;

use \Phreezer\Storage\CouchDB;

class Schivel
{
	use Traits\SimpleQueries;

	private $db;

	public function __construct(CouchDB $db){
		$this->db = $db;
	}

	public function store($object){
		return $this->db->store($object);
	}

	public function fetch($id){
		return $this->db->fetch($id);
	}
}
