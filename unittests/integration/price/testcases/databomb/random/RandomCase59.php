<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '9ee00cf1e440c85159742a8d667455a1',
      'oxprice' => 306.07,
      'oxvat' => 7,
      'amount' => 38,
    ),
    2 => 
    array (
      'oxid' => '318a72ec064f7d808c73d81e005ac160',
      'oxprice' => 258.62,
      'oxvat' => 11,
      'amount' => 877,
    ),
    3 => 
    array (
      'oxid' => 'c6d10643104ec532f87b949747f68b1e',
      'oxprice' => 265.37,
      'oxvat' => 34,
      'amount' => 199,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '9ee00cf1e440c85159742a8d667455a1' => 
      array (
        0 => '306,07',
        1 => '11.630,66',
      ),
      '318a72ec064f7d808c73d81e005ac160' => 
      array (
        0 => '258,62',
        1 => '226.809,74',
      ),
      'c6d10643104ec532f87b949747f68b1e' => 
      array (
        0 => '265,37',
        1 => '52.808,63',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        7 => '760,88',
        11 => '22.476,64',
        34 => '13.399,20',
      ),
      'totalNetto' => '254.612,31',
      'totalBrutto' => '291.249,03',
      'grandTotal' => '291.249,03',
    ),
  ),
);