<?php
namespace FileConverter;
use FileConverter\Controller\ControllerConverter as controller;
use FileConverter\Object\CSV as CSV;
include "../"."SPL_autoload_register.php";
use FileConverter\Enum\EnumMethodClass;
use FileConverter\Enum\EnumMethodData;
	class CSVConverter
	{
		private $query;
		public function reset():	void
		{
			$this->query = new \stdClass();
		}
		public function file(string $file)
		{
			$this->file = $file;
			return $this;
		}
		public function Where(array $data)
		{
			$this->reset();
			$this->query->Where = $data;
			return $this;
		}
		public function AndWhere(array $data)
		{
			$this->query->AndWhere = $data;
			return $this;
		}
		public function OrWhere(array $data)
		{
			$this->query->OrWhere = $data;
			return $this;
		}
		public function limit(array $limit)
		{
			$this->query->limit = $limit;
			return $this;
		}
		public function Layouts(string $layouts)
		{
			$this->query->Layouts = $layouts;
			return $this;
		}
		public function ConvertToXML()
		{
			$controller = new controller;
			if(isset($this->file))
			{
				$csv = new CSV;
				$csv->setfile($this->file);
			}
			if(isset($this->query->Where))
			{
				$csv->setWhere($this->query->Where);
			}
			if(isset($this->query->AndWhere))
			{
				$csv->setAndWhere($this->query->AndWhere);
			}
			if(isset($this->query->OrWhere))
			{
				$csv->setOrWhere($this->query->OrWhere);
			}
			if(isset($this->query->limit))
			{
				$csv->setlimit($this->query->limit);
			}
			if(isset($this->query->Layouts))
			{
				$csv->setLayouts($this->query->Layouts);
			}
			$controller = $controller->Get(EnumMethodClass::ConverterCsvToXML,$csv);
			return $controller;
		}
		public function ConvertToHTML()
		{
			$controller = new controller;
			if(isset($this->file))
			{
				$csv = new CSV;
				$csv->setfile($this->file);
			}
			if(isset($this->query->Where))
			{
				$csv->setWhere($this->query->Where);
			}
			if(isset($this->query->AndWhere))
			{
				$csv->setAndWhere($this->query->AndWhere);
			}
			if(isset($this->query->OrWhere))
			{
				$csv->setOrWhere($this->query->OrWhere);
			}
			if(isset($this->query->limit))
			{
				$csv->setlimit($this->query->limit);
			}
			if(isset($this->query->Layouts))
			{
				$csv->setLayouts($this->query->Layouts);
			}
			$controller = $controller->Get(EnumMethodClass::ConverterCsvToHtml,$csv);
			return $controller;
		}
		public function CREATE(array $data)
		{
			$csv = new CSV;
			$csv->setfile($this->file);
			$csv->SetData($data);
			$controller = new controller;
			$controller->Method(EnumMethodData::CREATE);
			$controller->Get(EnumMethodClass::ConverterDataToCSV,$csv);
		}
		public function ADD(array $data)
		{
			$csv= new CSV;
			$csv->setfile($this->file);
			$csv->SetData($data);
			$controller = new controller;
			$controller->Method(EnumMethodData::ADD);
			$controller->Get(EnumMethodClass::ConverterDataToCSV,$csv);
		}
		public function DELETE(array $data)
		{
			$csv= new CSV;
			$csv->setfile($this->file);
			$csv->SetData($data);
			$controller = new controller;
			$controller->Method(EnumMethodData::DELETE);
			$controller->Get(EnumMethodClass::ConverterDataToCSV,$csv);
		}
		public function UPDATE(array $data,array $update)
		{
			ini_set('display_errors', 1);
			ini_set('display_startup_errors', 1);
			error_reporting(E_ALL);
			$csv= new CSV;
			$csv->setfile($this->file);
			$csv->SetData(['s_update'=>$data,'update'=>$update]);
			$controller = new controller;
			$controller->Method(EnumMethodData::UPDATE);
			$controller->Get(EnumMethodClass::ConverterDataToCSV,$csv);
		}
	}
	$csvConverter = new CSVConverter;
	$csvConverter->file('personels.csv');
	$csvConverter = $csvConverter->Where(['key'=>'Surname','value'=>'Polakowski'])
							->OrWhere(['key'=>'Name','value'=>'Maciek'])
							->AndWhere(['key'=>'Name','value'=>'Mikolaj'])
							->limit(['offset'=>0,'limit'=>10])
							->Layouts(__DIR__.'/Template/layout/XML.xml')
							->ConvertToXML();
	echo $csvConverter;
	/*$csvConverter->CREATE([
	['Id'=>1,'Name'=>'Maciek','Surname'=>'Polakowski','Number'=>663123321],
	['Id'=>2,'Name'=>'Adam','Surname'=>'Kalinski','Number'=>123321],
	['Id'=>3,'Name'=>'Mikolaj','Surname'=>'Wierch','Number'=>123321],
	['Id'=>4,'Name'=>'Mikolaj','Surname'=>'Kalinski','Number'=>123321],
	['Id'=>5,'Name'=>'Wiktor','Surname'=>'Stachurski','Number'=>123321],
	['Id'=>6,'Name'=>'Monika','Surname'=>'Wierch','Number'=>123321],
	['Id'=>7,'Name'=>'Adam','Surname'=>'Polakowski','Number'=>123321],
	['Id'=>8,'Name'=>'Wiktoria','Surname'=>'Prokop','Number'=>123321],
	['Id'=>9,'Name'=>'Madzia','Surname'=>'Wieso³a','Number'=>123321],
	['Id'=>10,'Name'=>'Maciek','Surname'=>'Wiktor','Number'=>123321],
	]);*/
	//$csvConverter->ADD([['Id'=>11,'Name'=>'Mikolaj','Surname'=>'Starosz','Number'=>0,'Sex'=>'Male'],['Id'=>12,'Name'=>'Mikolaj','Surname'=>'Starosz','Number'=>0,'Sex'=>'Male']]);
	//$csvConverter->Delete([['value'=>2],['value'=>3]]);
	//$csvConverter->Update(['key'=>'Id','value'=>1],['Id'=>1,'Name'=>'Alek','Surname'=>'Walaszek','Number'=>123321,'Sex'=>'Male']);
?>