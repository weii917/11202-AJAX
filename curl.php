<?php
$stock = file_get_contents("https://mis.twse.com.tw/stock/api/getStockInfo.jsp?ex_ch=tse_2330.tw&json=1&delay=0&_=1710118449049");
$stock = trim($stock);
echo $stock;
