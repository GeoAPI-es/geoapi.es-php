<?php

namespace GeoAPI\GeoAPI;

class GeoAPI {

	private $conf = array(
		'url' => 'http://geoapi.es/API/',
		'type' => 'JSON',
		'key' => '',
		'sandbox' => 0
	);

	private $_data = array(
		'lastQuery' => array(
			'url' => '',
			'params' => array()
		),
		'lastResult' => array(
			'status' => 0,
			'data' => array()
		)
	);
	
	public function setConfig($key, $value){
		$this->conf[$key] = $value;
	}

	public function getLastQuery(){
		return $this->$_data['lastQuery'];
	}

	public function getLastResult(){
		return $this->$_data['lastResult'];
	}
	
	private function _call($accion, $params, $deferred){
		$params = array_merge($params, $this->conf);
		unset($params['url']);
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
			CURLOPT_TIMEOUT => 15,
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_ENCODING => 'gzip,deflate',
			CURLOPT_HTTPHEADER => array("Cache-Control: max-age=0", "Accept-Charset: utf-8;"),
			CURLOPT_URL => sprintf("%s%s?%s", $this->conf['url'], $accion, http_build_query($params))
		));
		
		$resp = curl_exec($curl);
		
		if(curl_errno($curl) || curl_getinfo($curl, CURLINFO_HTTP_CODE) != 200){
			$deferred->reject($resp);
			echo "Error: " . curl_error($resp);
		}else{
			$data = json_decode($resp, true);

			$this->_data = array(
				'lastQuery' => array(
					'url' => sprintf("%s%s", $this->conf['url'], $accion),
					'params' => $params
				),
				'lastResult' => array(
					'status' => curl_getinfo($curl, CURLINFO_HTTP_CODE),
					'data' => $data['data']
				)
			);

			$deferred->resolve($data['data']);
		}

		curl_close($curl);
		return $deferred->promise();
	}

	public function calles($params){ /*CPRO, CMUM, CUN, CPOS*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('calles', $params, $deferred);
	}

	public function comunidades($params){ /**/
		$deferred = new React\Promise\Deferred();
		return $this->_call('comunidades', $params, $deferred);
	}

	public function cps($params){ /*CPRO, CMUM, CUN*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('cps', $params, $deferred);
	}

	public function municipios($params){ /*CPRO*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('municipios', $params, $deferred);
	}

	public function nucleos($params){ /*CPRO, CMUM, NENTSI50*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('nucleos', $params, $deferred);
	}

	public function poblaciones($params){ /*CPRO, CMUM*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('poblaciones', $params, $deferred);
	}

	public function provincias($params){ /*CCOM*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('provincias', $params, $deferred);
	}

	public function qcalles($params){ /*QUERY*/
		$deferred = new React\Promise\Deferred();
		return $this->_call('qcalles', $params, $deferred);
	}
}

?>