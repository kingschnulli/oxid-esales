<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'afd7e04792adfae6a2ae01be4eb210b5',
      'oxprice' => 857.78,
      'oxvat' => 0,
      'amount' => 53,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'afd7e04792adfae6a2ae01be4eb210b5' => 
      array (
        0 => '857,78',
        1 => '45.462,34',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        0 => '0,00',
      ),
      'totalNetto' => '45.462,34',
      'totalBrutto' => '45.462,34',
      'grandTotal' => '45.462,34',
    ),
  ),
);