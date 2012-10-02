<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '567b20a8f8fd1a7d81560cc71ea8fd40',
      'oxprice' => 932.68,
      'oxvat' => 28,
      'amount' => 832,
    ),
    2 => 
    array (
      'oxid' => 'b1fc8cafd4ba462e06797f85b77e1053',
      'oxprice' => 16.94,
      'oxvat' => 30,
      'amount' => 772,
    ),
    3 => 
    array (
      'oxid' => 'b7446084e5b0e0d166d5566e8434e8aa',
      'oxprice' => 442.11,
      'oxvat' => 30,
      'amount' => 187,
    ),
    4 => 
    array (
      'oxid' => 'f0ad9b6200b204312cf6472b86b117cf',
      'oxprice' => 729.71,
      'oxvat' => 28,
      'amount' => 53,
    ),
    5 => 
    array (
      'oxid' => 'd5db9458fd48763e84867c27fc4fb0cd',
      'oxprice' => 38.69,
      'oxvat' => 30,
      'amount' => 901,
    ),
    6 => 
    array (
      'oxid' => '403606c637e3cd486766e65b934b5077',
      'oxprice' => 960.37,
      'oxvat' => 1,
      'amount' => 752,
    ),
    7 => 
    array (
      'oxid' => 'a537e57ca47af743f36c37575c58186a',
      'oxprice' => 964.15,
      'oxvat' => 1,
      'amount' => 311,
    ),
    8 => 
    array (
      'oxid' => '2b7a8e8bf7f06416b0dcc01ed4026a4a',
      'oxprice' => 873.42,
      'oxvat' => 1,
      'amount' => 296,
    ),
    9 => 
    array (
      'oxid' => '37eb567f0f52dc5959bda2af0cadd818',
      'oxprice' => 313.21,
      'oxvat' => 26,
      'amount' => 697,
    ),
    10 => 
    array (
      'oxid' => '77c75f3a914298fd4f705556c96ecb1b',
      'oxprice' => 433.69,
      'oxvat' => 1,
      'amount' => 324,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '567b20a8f8fd1a7d81560cc71ea8fd40' => 
      array (
        0 => '932,68',
        1 => '775.989,76',
      ),
      'b1fc8cafd4ba462e06797f85b77e1053' => 
      array (
        0 => '16,94',
        1 => '13.077,68',
      ),
      'b7446084e5b0e0d166d5566e8434e8aa' => 
      array (
        0 => '442,11',
        1 => '82.674,57',
      ),
      'f0ad9b6200b204312cf6472b86b117cf' => 
      array (
        0 => '729,71',
        1 => '38.674,63',
      ),
      'd5db9458fd48763e84867c27fc4fb0cd' => 
      array (
        0 => '38,69',
        1 => '34.859,69',
      ),
      '403606c637e3cd486766e65b934b5077' => 
      array (
        0 => '960,37',
        1 => '722.198,24',
      ),
      'a537e57ca47af743f36c37575c58186a' => 
      array (
        0 => '964,15',
        1 => '299.850,65',
      ),
      '2b7a8e8bf7f06416b0dcc01ed4026a4a' => 
      array (
        0 => '873,42',
        1 => '258.532,32',
      ),
      '37eb567f0f52dc5959bda2af0cadd818' => 
      array (
        0 => '313,21',
        1 => '218.307,37',
      ),
      '77c75f3a914298fd4f705556c96ecb1b' => 
      array (
        0 => '433,69',
        1 => '140.515,56',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        28 => '178.207,84',
        30 => '30.141,22',
        1 => '14.070,27',
        26 => '45.047,55',
      ),
      'totalNetto' => '2.317.213,59',
      'totalBrutto' => '2.584.680,47',
      'grandTotal' => '2.584.680,47',
    ),
  ),
);