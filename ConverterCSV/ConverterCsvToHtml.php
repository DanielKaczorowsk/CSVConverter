<?php
namespace FileConverter\ConverterCSV;
use FileConverter\Template\Template as template;
use FileConverter\Parser\ParserCSV as p_csv;
	Class ConverterCsvToHtml implements ConverterInterface
	{
		private $file,$layouts,$template;
		public function Convert(Object $data)
		{
			$p_csv = new p_csv;
			if(null!==$data->getfile())
			{
				$p_csv->file(__DIR__.'/../'.$data->getfile());
			}
			if(null!==$data->getWhere())
			{
				$p_csv->Where($data->getWhere());
			}
			if(null!==$data->getOrWhere())
			{
				$p_csv->OrWhere($data->getOrWhere());
			}
			if(null!==$data->getAndWhere())
			{
				$p_csv->AndWhere($data->getAndWhere());
			}
			if(null!==$data->getlimit())
			{
				$p_csv->limit($data->getlimit());
			}
			$p_csv = $p_csv->parse();
			if(null!==$data->getLayouts())
			{
				$this->template = new template;
				$this->template = $this->template
 					->file(__DIR__.'/../'.'Template/template/ConventerHTML.html')
					->title('Conventer HTML')
					->data(array('CSVHTML'=>$p_csv))
					->contents(__DIR__.'/../'.'Template/layout/HTML.html')
					->render();
				return $this->template;
			}
			else
			{
				return $p_csv;
			}
		}
	}
?>