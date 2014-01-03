<?php

namespace Acme\DemoBundle\Assetic;

use Assetic\ValueSupplierInterface;

class ValueSupplier implements ValueSupplierInterface {
	public function getValues() {
		return array("theme" => "foo");
	}
} 
