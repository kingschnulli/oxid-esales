<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '74315b2eded578d8bd6f8f800e5047ee',
      'oxprice' => 496.37,
      'oxvat' => 24,
      'amount' => 712,
    ),
    2 => 
    array (
      'oxid' => '6957472c1eac4a242d24c6dd3401f433',
      'oxprice' => 647.07,
      'oxvat' => 24,
      'amount' => 382,
    ),
    3 => 
    array (
      'oxid' => '478b471c1f7217a2ab12abce7e02d3f7',
      'oxprice' => 735.89,
      'oxvat' => 27,
      'amount' => 508,
    ),
    4 => 
    array (
      'oxid' => '7abf58d4c59e8011184dce8a2b9c0459',
      'oxprice' => 506.69,
      'oxvat' => 22,
      'amount' => 936,
    ),
    5 => 
    array (
      'oxid' => '68ceeab5964f35b4341dec672b71bcb5',
      'oxprice' => 520.38,
      'oxvat' => 27,
      'amount' => 777,
    ),
    6 => 
    array (
      'oxid' => 'ddafaa7845e22d88d79fcc61dae833db',
      'oxprice' => 610.49,
      'oxvat' => 30,
      'amount' => 477,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '74315b2eded578d8bd6f8f800e5047ee' => 
      array (
        0 => '496,37',
        1 => '353.415,44',
      ),
      '6957472c1eac4a242d24c6dd3401f433' => 
      array (
        0 => '647,07',
        1 => '247.180,74',
      ),
      '478b471c1f7217a2ab12abce7e02d3f7' => 
      array (
        0 => '735,89',
        1 => '373.832,12',
      ),
      '7abf58d4c59e8011184dce8a2b9c0459' => 
      array (
        0 => '506,69',
        1 => '474.261,84',
      ),
      '68ceeab5964f35b4341dec672b71bcb5' => 
      array (
        0 => '520,38',
        1 => '404.335,26',
      ),
      'ddafaa7845e22d88d79fcc61dae833db' => 
      array (
        0 => '610,49',
        1 => '291.203,73',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        24 => '116.244,42',
        27 => '165.437,16',
        22 => '85.522,63',
        30 => '67.200,86',
      ),
      'totalNetto' => '1.709.824,06',
      'totalBrutto' => '2.144.229,13',
      'grandTotal' => '2.144.229,13',
    ),
  ),
);