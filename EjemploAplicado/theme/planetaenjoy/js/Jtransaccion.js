function asignar_hora_combos(cbohora, cbomin){
 $("#"+cbohora).val(formatDate(new Date(), 'HH'));  
 $("#"+cbomin).val(formatDate(new Date(), 'mm')); 
}

function formatDate(date,format)
{
// alert('formatDate date='+date+' format='+format);
// Force parametres en chaine
format=format+"";
var result="";
var year=date.getYear()+""; if (year.length < 4) { year=""+(year-0+1900); }
var month=date.getMonth()+1;
var day=date.getDate();
var hour=date.getHours();
var minute=date.getMinutes();
var seconde=date.getSeconds();
var i=0;
while (i < format.length)
{
c=format.charAt(i); // Recupere char du format
substr="";
j=i;
while ((format.charAt(j)==c) && (j < format.length)) // Recupere char
// successif
// identiques
{
substr += format.charAt(j++);
}
// alert('substr='+substr);
if (substr == 'yyyy') { result=result+year; }
else if (substr == 'yy') { result=result+year.substring(2,4); }
else if (substr == 'M') { result=result+month; }
else if (substr == 'MM') { result=result+(month<1||month>9?"":"0")+month; }
else if (substr == 'd') { result=result+day; }
else if (substr == 'dd') { result=result+(day<1||day>9?"":"0")+day; }
else if (substr == 'hh') { if (hour > 12) hour-=12; result=result+(hour<0||hour>9?"":"0")+hour; }
else if (substr == 'HH') { result=result+(hour<0||hour>9?"":"0")+hour; }
else if (substr == 'mm') { result=result+(minute<0||minute>9?"":"0")+minute; }
else if (substr == 'ss') { result=result+(seconde<0||seconde>9?"":"0")+seconde; }
else { result=result+substr; }
i+=substr.length;
}
// alert(result);
return result;
}
/*
* =================================================================
* Function:
* getDateFromFormat(date_string, format_string) Purpose: This function takes a
* date string and a format string. It parses the date string with format and it
* returns the date as a javascript Date() object. If date does not match
* format, it returns 0. The format string can use the following tags:
* Field | Tags
* -------------+-----------------------------------
* Year | yyyy (4 digits), yy (2 digits)
* Month | MM (2 digits)
* Day of Month | dd (2 digits)
* Hour (1-12) | hh (2 digits)
* Hour (0-23) | HH (2 digits)
* Minute | mm (2 digits)
* Second | ss (2 digits)
* Author: Laurent Destailleur
* Licence: GPL
* ==================================================================
*/
function getDateFromFormat(val,format)
{
// alert('getDateFromFormat val='+val+' format='+format);
// Force parametres en chaine
val=val+"";
format=format+"";
if (val == '') return 0;
var now=new Date();
var year=now.getYear(); if (year.length < 4) { year=""+(year-0+1900); }
var month=now.getMonth()+1;
var day=now.getDate();
var hour=now.getHours();
var minute=now.getMinutes();
var seconde=now.getSeconds();
var i=0;
var d=0; // -d- follows the date string while -i- follows the format
// string
while (i < format.length)
{
c=format.charAt(i); // Recupere char du format
substr="";
j=i;
while ((format.charAt(j)==c) && (j < format.length)) // Recupere char
// successif
// identiques
{
substr += format.charAt(j++);
}
// alert('substr='+substr);
if (substr == "yyyy") year=getIntegerInString(val,d,4,4);
if (substr == "yy") year=""+(getIntegerInString(val,d,2,2)-0+1900);
if (substr == "MM" ||substr == "M")
{
month=getIntegerInString(val,d,1,2);
d -= 2- month.length;
}
if (substr == "dd")
{
day=getIntegerInString(val,d,1,2);
d -= 2- day.length;
}
if (substr == "HH" ||substr == "hh" )
{
hour=getIntegerInString(val,d,1,2);
d -= 2- hour.length;
}
if (substr == "mm"){
minute=getIntegerInString(val,d,1,2);
d -= 2- minute.length;
}
if (substr == "ss")
{
seconde=getIntegerInString(val,d,1,2);
d -= 2- seconde.length;
}
i+=substr.length;
d+=substr.length;
}
// Check if format param are ok
if (year==null||year<1) { return 0; }
if (month==null||(month<1)||(month>12)) { return 0; }
if (day==null||(day<1)||(day>31)) { return 0; }
if (hour==null||(hour<0)||(hour>24)) { return 0; }
if (minute==null||(minute<0)||(minute>60)) { return 0; }
if (seconde==null||(seconde<0)||(seconde>60)) { return 0; }
// alert(year+' '+month+' '+day+' '+hour+' '+minute+' '+seconde);
var newdate=new Date(year,month-1,day,hour,minute,seconde);
return newdate;
}

function getclientinfo(cardid){
    $.post("?load=transaccion&action=getClientInfo&ajaxRequest",{
              cardid:""+cardid+""  
            },function(data){
                if(data.length>0){
                    var obj = $.parseJSON(data);
                    $.each(obj,function(key,val){
                        if(key=="error"){
                            $("#"+val.ashooter+"").click();
                            $("."+val.container+"").html(val.msg);
                            if(val.ashooter == "showmessage_yesno"){
                                $(".yesclick").click(function(){
                                    $("#addcliente").click();
                                    $("#idtarjetanueva").val(cardid);
                                });
                            }
                        }else{
                            $.each(val,function(field,value){
                                $("#nombre_cliente").val(value[0].nombre_cliente);
                                $("#categoria_cliente").val(value[0].des_categoria);
                                $("#idcliente").val(value[0].id_cliente);
                            });
                            
                            
                        }
                    })
                }else{
                    alert("Error de conexi&oacute;n con el servidor, verifique su conexi&oacute;n a internet")
                }
                
            });
}

