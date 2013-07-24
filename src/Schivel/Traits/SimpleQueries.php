<?php

namespace Schivel\Traits;

trait SimpleQueries
{
	public function fetchIdByKey($view, $key){
		$result = $this->simpleQuery([
			'view'=>$view,
			'filter'=>'id_only',
			'key'=>$key
		]);
		return $result;
	}

	public function fetchIdByKeys($view, array $keys){
		$result = $this->simpleMultiQuery([
			'view'=>$view,
			'filter'=>'id_only',
			'keys'=>$keys
		]);
		return $result;
	}

	public function fetchDocByKey($view, $key){
		$result = $this->simpleQuery([
			'view'=>$view,
			'filter'=>'doc_only',
			'key'=>$key,
			'include_docs' => 'true'
		]);
		return $result;
	}

	public function fetchDocByKeys($view, array $keys){
		$result = $this->simpleMultiQuery([
			'view'=>$view,
			'filter'=>'doc_only',
			'keys'=>$keys,
			'include_docs' => 'true'
		]);
		return $result;
	}

	public function fetchDocstateByKey($view, $key){
		$result = $this->simpleQuery([
			'view'         => $view,
			'filter'       => 'docstate_only',
			'key'          => $key,
			'include_docs' => 'true'
		]);
		return $result;
	}

	public function fetchDocstateByKeys($view, array $keys){
		$result = $this->simpleMultiQuery([
			'view'=>$view,
			'filter'=>'docstate_only',
			'include_docs' => 'true',
			'keys'=>$keys
		]);
		return $result;
	}

	public function fetchValueByKey($view, $key){
		$result = $this->simpleQuery([
			'view'=>$view,
			'filter'=>'value_only',
			'key'=>$key
		]);
		return $result;
	}

	public function fetchValueByKeys($view, array $keys){
		$result = $this->simpleMultiQuery([
			'view'=>$view,
			'filter'=>'value_only',
			'keys'=>$keys
		]);
		return $result;
	}

	public function fetchObjectByKeys($view, array $keys){
		
	}

	public function fetchJsonByKeys($view, array $keys){
		
	}

	public function isDuplicate($view, $key){
		$result = $this->fetchIdByKey($view, $key);
		return count($result) > 0;
	}

	private function simpleQuery($params){
		$opts = array(
			'filter'=>$params['filter'],
			'blacklist'=>array('__phreezer_hash')
		);
		$query = array(
			'key'=>json_encode($params['key'])
		);
		if(isset($params['include_docs'])){
			$query['include_docs'] = $params['include_docs'];
		}
		$result = $this->db->_view->query($params['view'], array(
			'query'=>$query,
			'opts'=>$opts
		));
		return $result['rows'];
	}

	private function simpleMultiQuery($params){
		$opts = array(
			'filter'=>$params['filter'],
			'blacklist'=>array('__phreezer_hash')
		);
		$query = array(
			'keys'=>json_encode($params['keys'])
		);
		if(isset($params['include_docs'])){
			$query['include_docs'] = $params['include_docs'];
		}
		$result = $this->db->_view->query($params['view'], array(
			'query'=>$query,
			'opts'=>$opts
		));
		return $result['rows'];
	}
}
