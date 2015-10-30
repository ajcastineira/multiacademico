/* 
 * Arxis (c) 2015 - Todos los derechos reservados.
 */

define(['multiacademico/multiacademico'], function(module){

    "use strict";
    
    return module.registerService('EnLetras', function()
    {
    function number_format(number, decimals, dec_point, thousands_sep) {

  number = (number + '')
    .replace(/[^0-9+\-Ee.]/g, '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + (Math.round(n * k) / k)
        .toFixed(prec);
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n))
    .split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '')
    .length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1)
      .join('0');
  }
  return s.join(dec);
}

    return { EnLetras:
                {
                  Void : "",
                  SP : " ",
                  Dot : ".",
                  Zero : "0",
                  Neg : "Menos",

                ValorEnLetras:function (x, Moneda)
                {
                    if (typeof(Moneda)==='undefined'){Moneda="";}
                    var s="";
                    var Ent;
                    var Frc;
                    var Signo="";

                    if(parseFloat(x) < 0)
                    {Signo = this.Neg + " ";}
                    else
                    {Signo = "";}

                    if(!(x%1===0)) //<- averiguar si tiene decimales
                      s = number_format(x,2,'.','');
                    else
                      //s = number_format(x,1,'.','');
                     s = x.toString();

                    var Pto = s.indexOf(this.Dot);

                    if (Pto === -1)
                    {
                      Ent = s;
                      Frc = this.Void;
                    }
                    else
                    {
                      Ent = s.substr(0,Pto);
                      Frc =  s.substr(Pto+1);
                    }

                    if (Ent === this.Zero || Ent === this.Void)
                    {  s = "Cero ";
                    }
                    else if( Ent.length > 7)
                    {
                       s = this.SubValLetra(parseInt(Ent.substr(0,Ent.length-6))) +
                               "Millones " + this.SubValLetra(parseInt(Ent.substr(-6, 6)));
                    }
                    else
                    {
                      s = this.SubValLetra(parseInt(Ent));

                    }

                    if (s.substr(-9, 9) === "Millones " || s.substr(-7, 7) === "Millón ")
                    { s = s + "de ";}

                    s = s + Moneda;

                    if(Frc !== this.Void)
                    {

                       s = s + " coma " + this.SubValLetra(parseInt(Frc)) + "";
                       //s = s + " " + Frc + "/100";
                    }
                    var valorenletras=Signo + s + " ";
                    valorenletras=valorenletras.replace("y Cero", "");
                    return (valorenletras);

                },


                SubValLetra: function (numero)
                {
                    var Ptr;
                    var n=0;
                    var i=0;
                    var x ="";
                    var Rtn ="";
                    var Tem ="";

                    x = numero.toString().trim();
                    n = x.length;
                    Tem = this.Void;
                    i = n;

                    while( i > 0)
                    {
                       Tem = this.Parte(parseInt(x.substr((n-i),1) + this.Zero.repeat(i-1)));
                       if( Tem !== "Cero" )
                       {Rtn = Rtn + Tem + this.SP;}
                       i--;
                    };


                    //--------------------- GoSub FiltroMil ------------------------------
                    Rtn=Rtn.replace(" Mil Mil"," Un Mil");
                    while(1)
                    {
                       Ptr = Rtn.indexOf("Mil ");
                       if(!(Ptr===-1))
                       {
                          if(! (Rtn.indexOf("Mil ",Ptr + 1) === -1 ))
                          {Rtn=this.ReplaceStringFrom(Rtn, "Mil ", "", Ptr);}
                          else
                          {break;}
                       }
                       else
                       {break;}
                    }

                    //--------------------- GoSub FiltroCiento ------------------------------
                    Ptr=-1;
                    do{
                       Ptr = Rtn.indexOf( "Cien ", Ptr+1);
                       if(!(Ptr===-1))
                       {
                          Tem = Rtn.substr( Ptr + 5 ,1);
                          if(!( Tem === "M" || Tem === this.Void))
                          {Rtn=this.ReplaceStringFrom(Rtn, "Cien", "Ciento", Ptr);}
                       }
                    }while(!(Ptr === -1));

                    //--------------------- FiltroEspeciales ------------------------------
                    Rtn=Rtn.replace("Diez Cero", "Diez");
                    Rtn=Rtn.replace("Diez Uno", "Once");
                    Rtn=Rtn.replace("Diez Dos", "Doce");
                    Rtn=Rtn.replace("Diez Tres", "Trece");
                    Rtn=Rtn.replace("Diez Cuatro", "Catorce");
                    Rtn=Rtn.replace("Diez Cinco", "Quince");
                    Rtn=Rtn.replace("Diez Seis", "Dieciseis");
                    Rtn=Rtn.replace("Diez Siete", "Diecisiete");
                    Rtn=Rtn.replace("Diez Ocho", "Dieciocho");
                    Rtn=Rtn.replace("Diez Nueve", "Diecinueve");
                    Rtn=Rtn.replace("Veinte Cero", "Veinte");
                    Rtn=Rtn.replace("Veinte Uno", "Veintiuno");
                    Rtn=Rtn.replace("Veinte Dos", "Veintidos");
                    Rtn=Rtn.replace("Veinte Tres", "Veintitres");
                    Rtn=Rtn.replace("Veinte Cuatro", "Veinticuatro");
                    Rtn=Rtn.replace("Veinte Cinco", "Veinticinco");
                    Rtn=Rtn.replace("Veinte Seis", "Veintiseis");
                    Rtn=Rtn.replace("Veinte Siete", "Veintisiete");
                    Rtn=Rtn.replace("Veinte Ocho", "Veintiocho");
                    Rtn=Rtn.replace("Veinte Nueve", "Veintinueve");


                    //--------------------- FiltroUn ------------------------------
                    if(Rtn.substr(0,1) === "M") {Rtn = "Un " + Rtn;}
                    //--------------------- Adicionar Y ------------------------------
                    for(i=65; i<=88; i++)
                    {
                      if(i !== 77)
                      {Rtn=Rtn.replace("a " + String.fromCharCode(i), "* y " + String.fromCharCode(i));}
                    }
                    Rtn=Rtn.replace("*", "a");
                    return Rtn;

                },


                ReplaceStringFrom:function(x, OldWrd, NewWrd, Ptr)
                {
                  var res = x.substr(0, Ptr)  + NewWrd + x.substr(OldWrd.length + Ptr);
                  return res;
                },


                Parte: function (x)
                {
                    var Rtn="";
                    var t="";
                    var i=0;
                    do
                    {
                      switch(x)
                      {
                         case 0:  t = "Cero";break;
                         case 1:  t = "Uno";break;
                         case 2:  t = "Dos";break;
                         case 3:  t = "Tres";break;
                         case 4:  t = "Cuatro";break;
                         case 5:  t = "Cinco";break;
                         case 6:  t = "Seis";break;
                         case 7:  t = "Siete";break;
                         case 8:  t = "Ocho";break;
                         case 9:  t = "Nueve";break;
                         case 10: t = "Diez";break;
                         case 20: t = "Veinte";break;
                         case 30: t = "Treinta";break;
                         case 40: t = "Cuarenta";break;
                         case 50: t = "Cincuenta";break;
                         case 60: t = "Sesenta";break;
                         case 70: t = "Setenta";break;
                         case 80: t = "Ochenta";break;
                         case 90: t = "Noventa";break;
                         case 100: t = "Cien";break;
                         case 200: t = "Doscientos";break;
                         case 300: t = "Trescientos";break;
                         case 400: t = "Cuatrocientos";break;
                         case 500: t = "Quinientos";break;
                         case 600: t = "Seiscientos";break;
                         case 700: t = "Setecientos";break;
                         case 800: t = "Ochocientos";break;
                         case 900: t = "Novecientos";break;
                         case 1000: t = "Mil";break;
                         case 1000000: t = "Millón";break;
                      }

                      if(t === this.Void)
                      {
                        i = i + 1;
                        x = x / 1000;
                        if(x === 0) {i = 0;};
                      }
                      else
                      { break;}

                    } while(i !== 0);

                    Rtn = t;
                    switch(i)
                    {
                       case 0: t = this.Void;break;
                       case 1: t = " Mil";break;
                       case 2: t = " Millones";break;
                       case 3: t = " Billones";break;
                    };
                    return Rtn + t;
                }

}
        };
    });
    
});
