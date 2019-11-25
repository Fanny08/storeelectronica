<?php
function vacio($input){		
	$remplazado = str_replace(' ','',$input);
	if(strlen($remplazado)!=0){
		return true;
	}else{
		return false;
	}
}
?>