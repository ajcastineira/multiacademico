function timeago($timestamp)
{
    
    var tempo= {
        "fechainteligente": function (timestamp) 
                             {
                                 
                                /*if (!is_int(timestamp)and !is_numeric(timestamp)) 
                                {
                                        timestamp=strtotime(timestamp, 0);
                                }*/
                                var $diff = Math.floor(Date.now()/1000) - timestamp;
                                if ($diff <= 0) return 'Ahora';
                                else if ($diff < 60) return "hace "+this.ConSoSinS(Math.floor($diff), ' segundo(s)');
                                else if ($diff < 60*60) return "hace "+this.ConSoSinS(Math.floor($diff/60), ' minuto(s)');
                                else if ($diff < 60*60*24) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60)), ' hora(s)');
                                else if ($diff < 60*60*24*30) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24)), ' día(s)');
                                else if ($diff < 60*60*24*30*12) return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24*30)), ' mes(es)');
                                else return "hace "+this.ConSoSinS(Math.floor($diff/(60*60*24*30*12)), ' año(s)');
                             },
        "getColor": function (timestamp)
        {
                /*if (!is_int($timestamp)) 
                {
                        timestamp=strtotime($timestamp, 0);
                }*/
                var $diff = Math.floor(Date.now()/1000) - timestamp;
                if ($diff <= 0) return 'orange';
                else if ($diff < 60) return "orange";
                else if ($diff < 60*60) return "green";
                else if ($diff < 60*60*24) return "blue";
                else if ($diff < 60*60*24*30) return "grey";
                else if ($diff < 60*60*24*30*12) return "grey";
                else return "grey";
             },
     "ConSoSinS": function(val, sentence) 
     {
        if (val > 1) return val+sentence.replace(/\u0028|\u0029/g, '');
	else return val+sentence.replace(/\u0028s\u0029|\u0028es\u0029/g, '');
     }
 };
    return tempo.fechainteligente($timestamp);
}