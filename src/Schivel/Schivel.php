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

	public function setDatabase($database){
		$this->db->database = $database;
	}

	public function setScheme($scheme){
		$this->db->scheme = $scheme;
	}

	public function setHost($host){
		$this->db->host = $host;
	}

	public function setPort($port){
		$this->db->port = $port;
	}

	public function setUsername($user){
		$this->db->user = $user;
	}

	public function setPassword($pass){
		$this->db->pass = $pass;
	}

	public function store($object){
		return $this->db->store($object);
	}

	public function fetch($id){
		return $this->db->fetch($id);
	}
}
