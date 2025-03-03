<?php
namespace FileConverter\ConverterCSV;
use FileConverter\Parser\ParserCSV as p_csv;
use FileConverter\Enum\EnumMethodData;
	trait Save
	{
		public function save($fields,$file)
		{
			$i = 0;
			$this->fields = $fields;
			foreach($this->fields as $keys => $fields)
			{
				foreach($fields as $key => $field)
				{
					$keyes[] = $key;
					$i++;
					$fields[$i] = $fields[$key];
					unset($fields[$key]);
				}
				$dats[] = $fields;
			}
			$this->fields = array_merge_recursive(array(array_unique($keyes)),$dats);
			$this->file = fopen(__DIR__.'/../'.$file,'w');
			foreach($this->fields as $field)
			{
				fputcsv($this->file,$field,';');
			}
			fclose($this->file);
		}
	}
	Class ConverterDataToCSV implements ConverterInterface
	{
		use Save;
		private $file,$fields,$method;
		public function Create(string $file,array $data):void
		{
			$this->file = fopen(__DIR__.'/../'.$file,'w');
			$this->fields = $data;
			$this->save($this->fields,$file);
		}
		public function Add(string $file,array $fields):void
		{
			$p_csv = new P_csv;
			$data = $p_csv->file(__DIR__.'/../'.$file)
							->parse();
			$this->fields = array_merge_recursive($data,$fields);
			$this->save($this->fields,$file);
		}
		public function Delete(string $file, array $id):void
		{
			$p_csv = new P_csv;
			$this->fields = $p_csv->file(__DIR__.'/../'.$file)
							->Delete($id)
							->parse();
			$this->save($this->fields,$file);
			
		}
		public function Update(string $file,array $update):void
		{
			$p_csv = new P_csv;
			$this->fields = $p_csv->file(__DIR__.'/../'.$file)
							->Update($update)
							->parse();
			$this->save($this->fields,$file);
		}
		public function Method(EnumMethodData $method) :void
		{
			$this->method = $method;
		}
		public function Convert(Object $data)
		{
			match($this->method)
			{
				EnumMethodData::CREATE=>SELF::Create($data->getfile(),$data->getData()),
				EnumMethodData::ADD=>SELF::Add($data->getfile(),$data->getData()),
				EnumMethodData::UPDATE=>SELF::Update($data->getfile(),$data->getData()),
				EnumMethodData::DELETE=>SELF::Delete($data->getfile(),$data->getData()),
			};
		}
	}
?>