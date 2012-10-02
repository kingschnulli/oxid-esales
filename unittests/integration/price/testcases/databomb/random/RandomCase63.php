<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '6fd67a50099dbd71596bfa32a0ffe2b5',
      'oxprice' => 779.42,
      'oxvat' => 21,
      'amount' => 552,
    ),
    2 => 
    array (
      'oxid' => '6331bb9a79f329053b5ce6967c2f5be6',
      'oxprice' => 704.2,
      'oxvat' => 16,
      'amount' => 137,
    ),
    3 => 
    array (
      'oxid' => '9b0f8a74910eeaab536f57a9034cd530',
      'oxprice' => 951.24,
      'oxvat' => 16,
      'amount' => 639,
    ),
    4 => 
    array (
      'oxid' => 'a401927522e0f31c35e2530aab5dc7cf',
      'oxprice' => 181.8,
      'oxvat' => 3,
      'amount' => 444,
    ),
    5 => 
    array (
      'oxid' => 'b38dea39d140fc6f79328ac7b46cfea1',
      'oxprice' => 912.49,
      'oxvat' => 3,
      'amount' => 905,
    ),
    6 => 
    array (
      'oxid' => '1ebd7531f0bc994f5206e114748bd77e',
      'oxprice' => 97.12,
      'oxvat' => 16,
      'amount' => 629,
    ),
    7 => 
    array (
      'oxid' => 'f69a6c8da3274b943aefa798c812c7bf',
      'oxprice' => 699.86,
      'oxvat' => 25,
      'amount' => 561,
    ),
    8 => 
    array (
      'oxid' => '6aba44311bb96482e068b2918155aa1e',
      'oxprice' => 573.76,
      'oxvat' => 3,
      'amount' => 65,
    ),
    9 => 
    array (
      'oxid' => 'f3408af5ffe3dea25a042223f84954d0',
      'oxprice' => 133.23,
      'oxvat' => 16,
      'amount' => 95,
    ),
    10 => 
    array (
      'oxid' => '64a8f2818d9edebd2ff5a4067a961bfc',
      'oxprice' => 451.18,
      'oxvat' => 25,
      'amount' => 299,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '6fd67a50099dbd71596bfa32a0ffe2b5' => 
      array (
        0 => '779,42',
        1 => '430.239,84',
      ),
      '6331bb9a79f329053b5ce6967c2f5be6' => 
      array (
        0 => '704,20',
        1 => '96.475,40',
      ),
      '9b0f8a74910eeaab536f57a9034cd530' => 
      array (
        0 => '951,24',
        1 => '607.842,36',
      ),
      'a401927522e0f31c35e2530aab5dc7cf' => 
      array (
        0 => '181,80',
        1 => '80.719,20',
      ),
      'b38dea39d140fc6f79328ac7b46cfea1' => 
      array (
        0 => '912,49',
        1 => '825.803,45',
      ),
      '1ebd7531f0bc994f5206e114748bd77e' => 
      array (
        0 => '97,12',
        1 => '61.088,48',
      ),
      'f69a6c8da3274b943aefa798c812c7bf' => 
      array (
        0 => '699,86',
        1 => '392.621,46',
      ),
      '6aba44311bb96482e068b2918155aa1e' => 
      array (
        0 => '573,76',
        1 => '37.294,40',
      ),
      'f3408af5ffe3dea25a042223f84954d0' => 
      array (
        0 => '133,23',
        1 => '12.656,85',
      ),
      '64a8f2818d9edebd2ff5a4067a961bfc' => 
      array (
        0 => '451,18',
        1 => '134.902,82',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        21 => '74.669,72',
        16 => '107.319,05',
        3 => '27.489,82',
        25 => '105.504,86',
      ),
      'totalNetto' => '2.364.660,81',
      'totalBrutto' => '2.679.644,26',
      'grandTotal' => '2.679.644,26',
    ),
  ),
);