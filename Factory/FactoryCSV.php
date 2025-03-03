<?php
	namespace FileConverter\Factory;
	use FileConverter\ConverterCSV\ConverterCsvToXML as ConverterCsvToXML;
	use FileConverter\ConverterCSV\ConverterCsvToHtml as ConverterCsvToHtml;
	use FileConverter\ConverterCSV\ConverterDataToCSV as ConverterDataToCSV;
	use FileConverter\Enum\EnumMethodClass;
	use FileConverter\Enum\EnumMethodData;
	Class FactoryCSV
	{
		private $method,$csv;
		public function method(EnumMethodData $method)
		{
			$this->method = $method;
			return $this;
		}
		public function getCSVMethod(EnumMethodClass $method,Object $object)
		{
			match($method)
			{
				EnumMethodClass::ConverterCsvToXML => $this->csv = new ConverterCsvToXML,
				EnumMethodClass::ConverterCsvToHtml => $this->csv = new ConverterCsvToHtml,
				EnumMethodClass::ConverterDataToCSV => $this->csv = new ConverterDataToCSV,
			};
			if(isset($this->method))
			{
				$this->csv->Method($this->method);
			    $this->csv->convert($object);
			}
			else
			{
				return $this->csv->convert($object);
			}
		}
	}
?>