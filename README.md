# CSVConverter
# Create 
	  $csvConverter->CREATE([
    ['Id'=>1,'Name'=>'','Surname'=>'','Number'=>],
    ['Id'=>2,'Name'=>'','Surname'=>'','Number'=>],
    ]);*/
# Add
  	$csvConverter->ADD([['Id'=>1,'Name'=>'','Surname'=>'','Number'=>0,'Sex'=>''],          
    'Id'=>2,'Name'=>'','Surname'=>'','Number'=>0,'Sex'=>'']]);
# Update
	  $csvConverter->Update(['key'=>'Id','value'=>1],['Id'=>,'Name'=>'','Surname'=>'','Number'=>,'Sex'=>'']);
# Delete
    $csvConverter->Delete([['value'=>2],['value'=>3]]);
# ConvertToHTML
    $csvConverter = $csvConverter->Where(['key'=>'Surname','value'=>''])
						->OrWhere(['key'=>'Name','value'=>''])
						->AndWhere(['key'=>'Name','value'=>''])
						->limit(['offset'=>0,'limit'=>10])
						->Layouts(__DIR__.'/Template/layout/XML.xml')
						->ConvertToHTML();
# ConvertToXML
    $csvConverter = $csvConverter->Where(['key'=>'Surname','value'=>''])
						->OrWhere(['key'=>'Name','value'=>''])
						->AndWhere(['key'=>'Name','value'=>''])
						->limit(['offset'=>0,'limit'=>10])
						->Layouts(__DIR__.'/Template/layout/XML.xml')
						->ConvertToXML();
# Layout
    primary html or xml is in template folder
    @startforeach name=CSVHTML -> OrXML
      {foreach-Name}->name data
    @endforeach
