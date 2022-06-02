

<?php


trait Hydrate{
	function hydrate(array $donnees){
		//var_dump($donnees);
		foreach ($donnees as $key => $value){
			$method = 'set'.ucfirst($key);
			//var_dump ($value);

			if (method_exists($this, $method)){
//var_dump($this);
//var_dump($method);
//var_dump($value);
				$this->$method($value);
			}
		}
	}
}
?>
