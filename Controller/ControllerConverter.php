<?php
	namespace FileConverter\Controller;
	use FileConverter\Object\CSV as CSV;
	use FileConverter\Factory\FactoryCSV as FactoryCSV;
	use FileConverter\Enum\EnumMethodClass;
	use FileConverter\Enum\EnumMethodData;

		class ControllerConverter
		{
			private $Method;
			public function Method(EnumMethodData $method)
			{
				$this->Method=$method;
				return $this;
			}
			public function Get(EnumMethodClass $method,Object $csv)
			{
				$ConverterCSV = new FactoryCSV;
				if(isset($this->Method))
				{
					$ConverterCSV = $ConverterCSV->method($this->Method);
				}
				return $ConverterCSV->getCSVMethod($method,$csv);
			}
		}
		?>