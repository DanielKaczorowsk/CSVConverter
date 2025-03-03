<?php
	namespace FileConverter\Object;
		Class CSV
		{
			private $file,$data,$where,$orwhere,$andwhere,$limit,$layouts;
			public function getfile()
			{
				return $this->file;
			}
			public function setfile(string $file)
			{
				$this->file = $file;
			}
			public function getdata()
			{
				return $this->data;
			}
			public function setdata(array $data)
			{
				$this->data = $data;
			}
			public function getWhere()
			{
				return $this->where;
			}
			public function setWhere(array $where)
			{
				$this->where = $where;
			}
			public function getOrWhere()
			{
				return $this->orwhere;
			}
			public function setOrWhere(array $orwhere)
			{
				$this->orwhere = $orwhere;
			}
			public function getAndWhere()
			{
				return $this->andwhere;
			}
			public function setAndWhere(array $andwhere)
			{
				$this->andwhere = $andwhere;
			}
			public function getlimit()
			{
				return $this->limit;
			}
			public function setlimit(array $limit)
			{
				$this->limit = $limit;
			}
			public function getLayouts()
			{
				return $this->layouts;
			}
			public function setLayouts(string $layouts)
			{
				$this->layouts = $layouts;
			}
		}
?>
