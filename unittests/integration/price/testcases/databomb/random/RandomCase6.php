<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'e7828af46991a96c1fff836b3841fc6f',
      'oxprice' => 345.61,
      'oxvat' => 39,
      'amount' => 216,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'e7828af46991a96c1fff836b3841fc6f' => 
      array (
        0 => '345,61',
        1 => '74.651,76',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        39 => '20.945,46',
      ),
      'totalNetto' => '53.706,30',
      'totalBrutto' => '74.651,76',
      'grandTotal' => '74.651,76',
    ),
  ),
);