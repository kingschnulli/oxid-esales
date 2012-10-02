<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '737f6427504814fe5643c71ffcfd0622',
      'oxprice' => 109.15,
      'oxvat' => 9,
      'amount' => 507,
    ),
    2 => 
    array (
      'oxid' => '75f0fa7df2635c375bbf437930b1be98',
      'oxprice' => 681.5,
      'oxvat' => 9,
      'amount' => 606,
    ),
    3 => 
    array (
      'oxid' => 'e80e087e63ab7f6d8e1dd74a338d780b',
      'oxprice' => 798.45,
      'oxvat' => 9,
      'amount' => 778,
    ),
    4 => 
    array (
      'oxid' => '73341b83c536e52f9e8b496d08ff0186',
      'oxprice' => 599.21,
      'oxvat' => 9,
      'amount' => 785,
    ),
    5 => 
    array (
      'oxid' => '4db8ffe8e4cc6fe90229c4370324e8fd',
      'oxprice' => 524.88,
      'oxvat' => 9,
      'amount' => 597,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '737f6427504814fe5643c71ffcfd0622' => 
      array (
        0 => '109,15',
        1 => '55.339,05',
      ),
      '75f0fa7df2635c375bbf437930b1be98' => 
      array (
        0 => '681,50',
        1 => '412.989,00',
      ),
      'e80e087e63ab7f6d8e1dd74a338d780b' => 
      array (
        0 => '798,45',
        1 => '621.194,10',
      ),
      '73341b83c536e52f9e8b496d08ff0186' => 
      array (
        0 => '599,21',
        1 => '470.379,85',
      ),
      '4db8ffe8e4cc6fe90229c4370324e8fd' => 
      array (
        0 => '524,88',
        1 => '313.353,36',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        9 => '154.672,46',
      ),
      'totalNetto' => '1.718.582,90',
      'totalBrutto' => '1.873.255,36',
      'grandTotal' => '1.873.255,36',
    ),
  ),
);