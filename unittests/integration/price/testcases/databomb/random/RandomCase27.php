<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '751928cd5d5b1e440889c813afb9d2d8',
      'oxprice' => 103.84,
      'oxvat' => 40,
      'amount' => 985,
    ),
    2 => 
    array (
      'oxid' => 'b38b112b0ed2d5b15fe61a351b9dc412',
      'oxprice' => 32.91,
      'oxvat' => 6,
      'amount' => 790,
    ),
    3 => 
    array (
      'oxid' => '5caed3f68550738a317af2a285ebbfd8',
      'oxprice' => 831.54,
      'oxvat' => 6,
      'amount' => 362,
    ),
    4 => 
    array (
      'oxid' => 'ef2972f357731f6637b739c51a356a9a',
      'oxprice' => 311.38,
      'oxvat' => 9,
      'amount' => 280,
    ),
    5 => 
    array (
      'oxid' => 'fc64b75e33e4aba3169bdb55b24b78f3',
      'oxprice' => 954.56,
      'oxvat' => 18,
      'amount' => 838,
    ),
    6 => 
    array (
      'oxid' => 'f28fda536d35e9a8325c8b9e3f29616e',
      'oxprice' => 684.59,
      'oxvat' => 18,
      'amount' => 78,
    ),
    7 => 
    array (
      'oxid' => '4b75aeac7e12835f1b003484bedaced4',
      'oxprice' => 320.66,
      'oxvat' => 9,
      'amount' => 867,
    ),
    8 => 
    array (
      'oxid' => '511a28835517352c6db58492c490fd5b',
      'oxprice' => 971.55,
      'oxvat' => 9,
      'amount' => 128,
    ),
    9 => 
    array (
      'oxid' => 'a6d6d482645a6eba17030818d6fd37b5',
      'oxprice' => 750.26,
      'oxvat' => 35,
      'amount' => 166,
    ),
    10 => 
    array (
      'oxid' => '0e709e1f289ff8677b90134398de9106',
      'oxprice' => 96.67,
      'oxvat' => 40,
      'amount' => 955,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '751928cd5d5b1e440889c813afb9d2d8' => 
      array (
        0 => '103,84',
        1 => '102.282,40',
      ),
      'b38b112b0ed2d5b15fe61a351b9dc412' => 
      array (
        0 => '32,91',
        1 => '25.998,90',
      ),
      '5caed3f68550738a317af2a285ebbfd8' => 
      array (
        0 => '831,54',
        1 => '301.017,48',
      ),
      'ef2972f357731f6637b739c51a356a9a' => 
      array (
        0 => '311,38',
        1 => '87.186,40',
      ),
      'fc64b75e33e4aba3169bdb55b24b78f3' => 
      array (
        0 => '954,56',
        1 => '799.921,28',
      ),
      'f28fda536d35e9a8325c8b9e3f29616e' => 
      array (
        0 => '684,59',
        1 => '53.398,02',
      ),
      '4b75aeac7e12835f1b003484bedaced4' => 
      array (
        0 => '320,66',
        1 => '278.012,22',
      ),
      '511a28835517352c6db58492c490fd5b' => 
      array (
        0 => '971,55',
        1 => '124.358,40',
      ),
      'a6d6d482645a6eba17030818d6fd37b5' => 
      array (
        0 => '750,26',
        1 => '124.543,16',
      ),
      '0e709e1f289ff8677b90134398de9106' => 
      array (
        0 => '96,67',
        1 => '92.319,85',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        40 => '55.600,64',
        6 => '18.510,36',
        9 => '40.422,14',
        18 => '130.167,35',
        35 => '32.288,97',
      ),
      'totalNetto' => '1.712.048,65',
      'totalBrutto' => '1.989.038,11',
      'grandTotal' => '1.989.038,11',
    ),
  ),
);