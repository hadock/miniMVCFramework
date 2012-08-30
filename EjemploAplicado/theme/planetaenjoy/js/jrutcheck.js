function Valida_Rut(Objeto)
{
        var tmpstr = "";
        var intlargo = Objeto.value
        if (intlargo.length> 0)
        {
                var crut = Objeto.value
                largo = crut.length;
                if ( largo <2 )
                {
                        $(".simpledialogtext").html("El Rut ingresado es inv&aacute;lido");
                        $("#showmessage").click();
                        $("#"+Objeto.id).val("");
                        return false;
                }
                for ( i=0; i <crut.length ; i++ )
                if ( crut.charAt(i) != " " && crut.charAt(i) != "." && crut.charAt(i) != "-" )
                {
                        tmpstr = tmpstr + crut.charAt(i);
                }
                rut = tmpstr;
                crut=tmpstr;
                largo = crut.length;

                if ( largo> 2 )
                        rut = crut.substring(0, largo - 1);
                else
                        rut = crut.charAt(0);

                dv = crut.charAt(largo-1);

                if ( rut == null || dv == null )
                return 0;

                var dvr = "0";
                suma = 0;
                mul  = 2;

                for (i= rut.length-1 ; i>= 0; i--)
                {
                        suma = suma + rut.charAt(i) * mul;
                        if (mul == 7)
                                mul = 2;
                        else
                                mul++;
                }

                res = suma % 11;
                if (res==1)
                        dvr = "k";
                else if (res==0)
                        dvr = "0";
                else
                {
                        dvi = 11-res;
                        dvr = dvi + "";
                }

                if ( dvr != dv.toLowerCase() )
                {
                        $("#"+Objeto.id).val("");
                        $(".simpledialogtext").html("El Rut ingresado es inv&aacute;lido");
                        $("#showmessage").click();
                        return false;
                }
                return true;
        }
}

function formato_rut(Objeto){
    $("#"+Objeto.id).Rut();
}
