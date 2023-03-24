<?php 
function make_input($name,$id,$type,$css='',$val='',$add='',$out='',$click=''){
	return '<input type="'.$type.'" name="'.$name.'" id="'.$id.'" value="'.$val.'" class="'.$css.'" '.$add.' onclick="'.$click.'"/> '.$out;
}

function make_textarea($name,$id,$css='',$val='',$click=''){
	return '<textarea name="'.$name.'" id="'.$id.'" class="'.$css.'" onclick="'.$click.'">'.$val.'</textarea>';
}
?>