<?php

$balance_before = 100;
$paid = 60;

$balance_beforeInt = (int)$balance_before;
$paidInt = (int)$paid;
$balance_after = $balance_beforeInt - $paidInt;

echo "The balance after payment is $balance_after";

?>