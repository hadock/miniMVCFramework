<?php
if(is_array($response)){
    foreach($response as $key => $value):
        if($key == 'script'){
            echo "<script languaje='Javascript' type='text/javascript'>$value</script>";
        }
        if($key == 'include'){
            foreach($value as $key => $val):
                if(file_exists(_THEME_DIRNAME_.'V'.$val.'.php')){
                    $params = $response;
                    require _THEME_DIRNAME_.'V'.$val.'.php';
                }else{
                    echo ' ';
                }
            endforeach;
        }
    endforeach;
}else{
    echo $response;
}
?>
