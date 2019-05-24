<?php
namespace App\Service;

class Count
{

	public function getResults($input){

		$result = [];

		foreach($input as $k=>$v){

			if(is_numeric($v) && $v>0 && $v<99999){
				$result[$k] = $this->getBiggestNumber($v);
			}
			else{
				$result[$k] = 'invalid data, must be number between 1 and 99 999';
			}
		}

		return $result;
	}

	public function getBiggestNumber($n){

		$max = 1;

		for ($i = 1; $i <= $n; $i++) {
			$number = $this->countNumber($i);

			if($number > $max){
				$max = $number;
			}
		}

		return $max;
	}

	public function countNumber($i){

		if($i == 1 || $i % 2 == 0){
			$result = 1;
		}
		else{
			$index = ($i - 1)/2;
			$result = $this->countNumber($index) + $this->countNumber($index + 1);
		}

		return $result;
	}
}