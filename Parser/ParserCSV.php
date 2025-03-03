<?php
	namespace FileConverter\Parser;
		Class ParserCSV
		{
			private $query,$files,$file;
			public function reset() :void
			{
				$this->query = new \stdClass();
			}
			public function file(string $file)
			{
				$this->reset();
				$this->query->file = $file;
				return $this;
			}
			public function Where(array $where)
			{
				$this->query->Where = $where;
				return $this;
			}
			public function AndWhere(array $andwhere)
			{
				$this->query->AndWhere = $andwhere;
				return $this;
			}
			public function OrWhere(array $orwhere)
			{
				$this->query->OrWhere = $orwhere;
				return $this;
			}
			public function Update(array $update)
			{
				$this->query->Update['s_update'] = $update['s_update'];
				$this->query->Update['update'] = $update['update'];
				return $this;
			}
			public function Delete(array $delete)
			{
				$this->query->Delete = $delete;
				return $this;
			}
			public function limit(array $limit)
			{
				$this->query->limit = $limit;
				return $this;
			}
			public function parse()
			{
				$this->file = file($this->query->file,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
				foreach($this->file as $key => $data)
				{
					if($key === array_key_first($this->file))
					{
						$keys = explode(';',implode(str_getcsv($data)));
					}
					else
					{
						$rows = explode(';',implode(str_getcsv($data)));
						if(isset($this->query->Where['key'])&&isset($this->query->Where['value']))
						{
							 if(array_search($this->query->Where['value'],$rows)!==false&&array_search($this->query->Where['key'],$keys)!==false)
							 {
								foreach($rows as $k => $row)
								{
									$rows[$keys[$k]] = $rows[$k];
									unset($rows[$k]);
								}
									$this->files[] = $rows;
							 }
							 else if(isset($this->query->AndWhere['key'])&&isset($this->query->AndWhere['value']))
							 {
								 if(array_search($this->query->AndWhere['value'],$rows)!==false&&array_search($this->query->AndWhere['key'],$keys)!==false)
								{
									foreach($rows as $k => $row)
									{
										$rows[$keys[$k]] = $rows[$k];
										unset($rows[$k]);
									}
										$this->files[] = $rows;
								}
							}
						}
						else if(isset($this->query->Update['s_update']['key'])&&isset($this->query->Update['s_update']['value']))
						{
							foreach($rows as $k => $row)
							{
								$rows[$keys[$k]] = $rows[$k];
								unset($rows[$k]);
							}
							if(array_search($this->query->Update['s_update']['key'],$keys)!==false&&array_search($this->query->Update['s_update']['value'],$rows)!==false)
							{
								$rows=$this->query->Update['update'];
							}
							$this->files[] = $rows;
						}
						else if(isset($this->query->Delete))
						{
							foreach($rows as $k => $row)
							{
								$rows[$keys[$k]] = $rows[$k];
								unset($rows[$k]);
							}
								foreach($this->query->Delete as $delete)
								{
									if(array_search('Id',$keys)!==false&&array_search($delete['value'],$rows)!==false)
									{
										foreach($rows as $k => $row)
										{
											unset($rows[$k]);
										}
									}
								}
							$this->files[] = $rows;
						}
						else
						{
							foreach($rows as $k => $row)
							{
								$rows[$keys[$k]] = $rows[$k];
								unset($rows[$k]);
							}
							$this->files[] = $rows;
						}
					}
				}
				
				if($this->files===null)
				{
					 if(isset($this->query->OrWhere['key'])&&isset($this->query->OrWhere['value']))
					{
						foreach($this->file as $key => $data)
						{
							if($key === array_key_first($this->file))
							{
								$keys = explode(';',implode(str_getcsv($data)));
							}
							else
							{
								$rows = explode(';',implode(str_getcsv($data)));
								if(array_search($this->query->OrWhere['value'],$rows)!==false&&array_search($this->query->OrWhere['key'],$keys)!==false)
								{
									foreach($rows as $k => $row)
									{
										$rows[$keys[$k]] = $rows[$k];
										unset($rows[$k]);
									}
									$this->files[] = $rows;
								}
							}
						}
						if(isset($this->files))
						{
							if(isset($this->query->limit['offset'])&&isset($this->query->limit['limit']))
							{
								return array_slice($this->files, $this->query->limit['offset'], $this->query->limit['limit']);
							}
							else
							{
								return $this->files;
							}
						}
						else
						{
							echo 'Nie Znaleziono';
						}
					}
					else
					{
						echo 'Nie Znaleziono';
					}
				}
				else
				{
					if(isset($this->query->limit['offset'])&&isset($this->query->limit['limit']))
					{
						return array_slice($this->files, $this->query->limit['offset'], $this->query->limit['limit']);
					}
					else
					{
						return $this->files;
					}
				}
				
			}
		}
?>