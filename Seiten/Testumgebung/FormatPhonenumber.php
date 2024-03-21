<?php
$phonenumberNF = "+4915734928138";

if(!($phonenumberNF[0] == "0" && $phonenumberNF[1] == "0"))
{
    if(($phonenumberNF[0] == "+") && ($phonenumberNF[1] != "4" || $phonenumberNF[2] != "9"))
    {
        echo "fehler";

    }
    else
    {
        $search = array('|^0|','|/|', '| |', '|\.|');
        $repl = array("+49", '', '', '');
        $phonenumber = preg_replace($search, $repl, $phonenumberNF);
        echo "$phonenumberNF :: $phonenumber<br>
        ";
    }
}
else
{
    echo "fehler";
}
?>