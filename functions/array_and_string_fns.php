<?php

function nonRepeat($min,$max,$count) {

    //prevent function from hanging 
    //due to a request of more values than are possible    
    if($max - $min < $count) {
        return false;
    }

        $nonrepeatarray = array();
        for($i = 0; $i < $count; $i++) {
            $rand = rand($min,$max);

            //ensure value isn't already in the array
            //if it is, recalculate the rand until we
            //find one that's not in the array
            while(in_array($rand,$nonrepeatarray)) {
                    $rand = rand($min,$max);
                }

            //add it to the array
            $nonrepeatarray[$i] = $rand;
        }
    asort($nonrepeatarray);
    return $nonrepeatarray;
}

function url_cevir($yazi) {
    $yazi = trim($yazi);

    $eski = array('ü','Ü','ö','Ö','ş','Ş','ç','Ç','ı','İ','ğ','Ğ',' ');
    $yeni = array('%C3%BC','%C3%9C','%C3%B6','%C3%96','%C5%9F','%C5%9E','%C3%A7','%C3%87','%C4%B1','%C4%B0','%C4%9F','%C4%9E','%20');

    
    return str_replace($eski,$yeni,$yazi);
}

/* 
   input: tags(array) eg. [0]=80s [1]=alternatif rock
   output: tags(string) eg 80s + alternatif rock
*/
function tags_with_plus($params)
{
	foreach($params as $param)
	{
		$tagss .= $param.' + '; 
	}
	
	//strips last plus
    $tagss = substr($tagss, 0, -2);
	return $tagss;
}

?>