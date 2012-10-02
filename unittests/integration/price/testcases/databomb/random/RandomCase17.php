<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'ec0e9466e6bae04ba4fb78944fe45166',
      'oxprice' => 150.43,
      'oxvat' => 22,
      'amount' => 218,
    ),
    2 => 
    array (
      'oxid' => 'd0d37f09fdb44ab7f93c6155240b056f',
      'oxprice' => 317.22,
      'oxvat' => 22,
      'amount' => 806,
    ),
    3 => 
    array (
      'oxid' => '9f0a2bf82f8e696b5c3fd27e5a8ee247',
      'oxprice' => 161.18,
      'oxvat' => 22,
      'amount' => 183,
    ),
    4 => 
    array (
      'oxid' => '88f853212ebeb407060351ac0948c230',
      'oxprice' => 288.36,
      'oxvat' => 22,
      'amount' => 972,
    ),
    5 => 
    array (
      'oxid' => 'c6049c73bca10d561e0faf3988756cfb',
      'oxprice' => 861.51,
      'oxvat' => 42,
      'amount' => 630,
    ),
    6 => 
    array (
      'oxid' => 'eae7a68c72626651877f0cf794c94ef8',
      'oxprice' => 378.64,
      'oxvat' => 8,
      'amount' => 52,
    ),
    7 => 
    array (
      'oxid' => 'a30cf45f56312f3cd3f009f0e470b20e',
      'oxprice' => 322.93,
      'oxvat' => 8,
      'amount' => 717,
    ),
    8 => 
    array (
      'oxid' => '3b61760abd81f761b8837b4f995771cb',
      'oxprice' => 203.6,
      'oxvat' => 22,
      'amount' => 246,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'ec0e9466e6bae04ba4fb78944fe45166' => 
      array (
        0 => '150,43',
        1 => '32.793,74',
      ),
      'd0d37f09fdb44ab7f93c6155240b056f' => 
      array (
        0 => '317,22',
        1 => '255.679,32',
      ),
      '9f0a2bf82f8e696b5c3fd27e5a8ee247' => 
      array (
        0 => '161,18',
        1 => '29.495,94',
      ),
      '88f853212ebeb407060351ac0948c230' => 
      array (
        0 => '288,36',
        1 => '280.285,92',
      ),
      'c6049c73bca10d561e0faf3988756cfb' => 
      array (
        0 => '861,51',
        1 => '542.751,30',
      ),
      'eae7a68c72626651877f0cf794c94ef8' => 
      array (
        0 => '378,64',
        1 => '19.689,28',
      ),
      'a30cf45f56312f3cd3f009f0e470b20e' => 
      array (
        0 => '322,93',
        1 => '231.540,81',
      ),
      '3b61760abd81f761b8837b4f995771cb' => 
      array (
        0 => '203,60',
        1 => '50.085,60',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        22 => '116.913,86',
        42 => '160.532,07',
        8 => '18.609,64',
      ),
      'totalNetto' => '1.146.266,34',
      'totalBrutto' => '1.442.321,91',
      'grandTotal' => '1.442.321,91',
    ),
  ),
);