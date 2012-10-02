<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'ced89b9d5b9c6a860711ca18c815cbf4',
      'oxprice' => 487.02,
      'oxvat' => 35,
      'amount' => 210,
    ),
    2 => 
    array (
      'oxid' => '75eb6208e2f421755a3e8869147345be',
      'oxprice' => 246.9,
      'oxvat' => 14,
      'amount' => 808,
    ),
    3 => 
    array (
      'oxid' => '80e5fdd97af3f77a9a12a3cb6b4f7a7a',
      'oxprice' => 491.14,
      'oxvat' => 35,
      'amount' => 364,
    ),
    4 => 
    array (
      'oxid' => '2746260ce699f4688c03f3ebd86aa10a',
      'oxprice' => 531.68,
      'oxvat' => 27,
      'amount' => 676,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'ced89b9d5b9c6a860711ca18c815cbf4' => 
      array (
        0 => '487,02',
        1 => '102.274,20',
      ),
      '75eb6208e2f421755a3e8869147345be' => 
      array (
        0 => '246,90',
        1 => '199.495,20',
      ),
      '80e5fdd97af3f77a9a12a3cb6b4f7a7a' => 
      array (
        0 => '491,14',
        1 => '178.774,96',
      ),
      '2746260ce699f4688c03f3ebd86aa10a' => 
      array (
        0 => '531,68',
        1 => '359.415,68',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        35 => '72.864,60',
        14 => '24.499,41',
        27 => '76.411,21',
      ),
      'totalNetto' => '666.184,82',
      'totalBrutto' => '839.960,04',
      'grandTotal' => '839.960,04',
    ),
  ),
);