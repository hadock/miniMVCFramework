<?php
function cambiafecha_a_normal_inverida_cnguion($fecha){
    ereg( "([0-9]{2,4})-([0-9]{1,2})-([0-9]{1,2})", $fecha, $mifecha);
    $lafecha=$mifecha[3]."-".$mifecha[2]."-".$mifecha[1];
    return $lafecha;
}

function Truncate($str, $length=10, $trailing='...') {
      // take off chars for the trailing
      $length-=strlen($trailing);
      if (strlen($str) > $length)
      {
         // string exceeded length, truncate and add trailing dots
         return substr($str,0,$length).$trailing;
      }
      else
      {
         // string was already short enough, return the string
         $res = $str;
      }

      return $res;
}

function comprobar_email($email){
    $mail_correcto = 0;
    //compruebo unas cosas primeras
    if ((strlen($email) >= 6) && (substr_count($email,"@") == 1) && (substr($email,0,1) != "@") && (substr($email,strlen($email)-1,1) != "@")){
       if ((!strstr($email,"'")) && (!strstr($email,"\"")) && (!strstr($email,"\\")) && (!strstr($email,"\$")) && (!strstr($email," "))) {
          //miro si tiene caracter .
          if (substr_count($email,".")>= 1){
             //obtengo la terminacion del dominio
             $term_dom = substr(strrchr ($email, '.'),1);
             //compruebo que la terminación del dominio sea correcta
             if (strlen($term_dom)>1 && strlen($term_dom)<5 && (!strstr($term_dom,"@")) ){
                //compruebo que lo de antes del dominio sea correcto
                $antes_dom = substr($email,0,strlen($email) - strlen($term_dom) - 1);
                $caracter_ult = substr($antes_dom,strlen($antes_dom)-1,1);
                if ($caracter_ult != "@" && $caracter_ult != "."){
                   $mail_correcto = 1;
                }
             }
          }
       }
    }
    if ($mail_correcto)
       return true;
    else
       return false;
}

function deleteAccent($string){
    $newstring = str_replace('á', 'a', $string);
    $newstring = str_replace('é', 'e', $newstring);
    $newstring = str_replace('í', 'i', $newstring);
    $newstring = str_replace('ó', 'o', $newstring);
    $newstring = str_replace('ú', 'u', $newstring);
    return $newstring;
}
?>
