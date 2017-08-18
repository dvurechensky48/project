<?php
class Defender_xss
{
	finction __construct($inp)
	{
		$filter = array("<", ">","="," (",")",";","/");
  	foreach($inp as $num=>$xss){
        $inp[$num]=str_replace ($filter, "|", $xss);
     }
       return $inp;
	}
}
?>