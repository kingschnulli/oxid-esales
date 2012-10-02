<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'c7ce761124363da8d30bbe85c0c83f42',
      'oxprice' => 500.75,
      'oxvat' => 27,
      'amount' => 539,
    ),
    2 => 
    array (
      'oxid' => 'ddaa35c9d2dbef384d967de6be1dfba1',
      'oxprice' => 974.05,
      'oxvat' => 7,
      'amount' => 468,
    ),
    3 => 
    array (
      'oxid' => '1c7a031a9b09f970809ba2d7def1fab1',
      'oxprice' => 346.36,
      'oxvat' => 28,
      'amount' => 380,
    ),
    4 => 
    array (
      'oxid' => 'd22b2f8aa0f35a6face50259aef150fc',
      'oxprice' => 716.34,
      'oxvat' => 27,
      'amount' => 107,
    ),
    5 => 
    array (
      'oxid' => 'f2f8f648ae890bdbb6545f5acb3357e2',
      'oxprice' => 642.48,
      'oxvat' => 7,
      'amount' => 988,
    ),
    6 => 
    array (
      'oxid' => '1721f1233382d087b7fc50c2d7abef5c',
      'oxprice' => 839.48,
      'oxvat' => 15,
      'amount' => 613,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'c7ce761124363da8d30bbe85c0c83f42' => 
      array (
        0 => '500,75',
        1 => '269.904,25',
      ),
      'ddaa35c9d2dbef384d967de6be1dfba1' => 
      array (
        0 => '974,05',
        1 => '455.855,40',
      ),
      '1c7a031a9b09f970809ba2d7def1fab1' => 
      array (
        0 => '346,36',
        1 => '131.616,80',
      ),
      'd22b2f8aa0f35a6face50259aef150fc' => 
      array (
        0 => '716,34',
        1 => '76.648,38',
      ),
      'f2f8f648ae890bdbb6545f5acb3357e2' => 
      array (
        0 => '642,48',
        1 => '634.770,24',
      ),
      '1721f1233382d087b7fc50c2d7abef5c' => 
      array (
        0 => '839,48',
        1 => '514.601,24',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        27 => '73.676,54',
        7 => '71.349,34',
        28 => '28.791,18',
        15 => '67.121,90',
      ),
      'totalNetto' => '1.842.457,35',
      'totalBrutto' => '2.083.396,31',
      'grandTotal' => '2.083.396,31',
    ),
  ),
);