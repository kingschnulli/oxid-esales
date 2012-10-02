<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'f335cdcbb990e05bbabe377eb3bf636a',
      'oxprice' => 210.23,
      'oxvat' => 13,
      'amount' => 484,
    ),
    2 => 
    array (
      'oxid' => 'b4b475ace99e473ffcc23ab1b53b01b8',
      'oxprice' => 254.87,
      'oxvat' => 13,
      'amount' => 529,
    ),
    3 => 
    array (
      'oxid' => '8504b345b06634b46a8988b9a6282648',
      'oxprice' => 712.19,
      'oxvat' => 9,
      'amount' => 459,
    ),
    4 => 
    array (
      'oxid' => 'acd110945ce38a15d687304187463592',
      'oxprice' => 691.05,
      'oxvat' => 14,
      'amount' => 956,
    ),
    5 => 
    array (
      'oxid' => '1f012f044958598a3f1124de0029d4c7',
      'oxprice' => 660.67,
      'oxvat' => 39,
      'amount' => 207,
    ),
    6 => 
    array (
      'oxid' => '90ede32a27c9d39738b85c3228027720',
      'oxprice' => 286.46,
      'oxvat' => 14,
      'amount' => 918,
    ),
    7 => 
    array (
      'oxid' => '2737c8f8351007dc7d663732cb66f99f',
      'oxprice' => 729.03,
      'oxvat' => 14,
      'amount' => 382,
    ),
    8 => 
    array (
      'oxid' => '74ce9f066144c92e5398647fe3a5cdaa',
      'oxprice' => 167.26,
      'oxvat' => 39,
      'amount' => 92,
    ),
    9 => 
    array (
      'oxid' => 'f221fe5bc657677ca2cfc3cc8d3a64c7',
      'oxprice' => 726.26,
      'oxvat' => 14,
      'amount' => 365,
    ),
    10 => 
    array (
      'oxid' => '289d6ad4c73df596dc652392b6519877',
      'oxprice' => 340.3,
      'oxvat' => 9,
      'amount' => 633,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'f335cdcbb990e05bbabe377eb3bf636a' => 
      array (
        0 => '210,23',
        1 => '101.751,32',
      ),
      'b4b475ace99e473ffcc23ab1b53b01b8' => 
      array (
        0 => '254,87',
        1 => '134.826,23',
      ),
      '8504b345b06634b46a8988b9a6282648' => 
      array (
        0 => '712,19',
        1 => '326.895,21',
      ),
      'acd110945ce38a15d687304187463592' => 
      array (
        0 => '691,05',
        1 => '660.643,80',
      ),
      '1f012f044958598a3f1124de0029d4c7' => 
      array (
        0 => '660,67',
        1 => '136.758,69',
      ),
      '90ede32a27c9d39738b85c3228027720' => 
      array (
        0 => '286,46',
        1 => '262.970,28',
      ),
      '2737c8f8351007dc7d663732cb66f99f' => 
      array (
        0 => '729,03',
        1 => '278.489,46',
      ),
      '74ce9f066144c92e5398647fe3a5cdaa' => 
      array (
        0 => '167,26',
        1 => '15.387,92',
      ),
      'f221fe5bc657677ca2cfc3cc8d3a64c7' => 
      array (
        0 => '726,26',
        1 => '265.084,90',
      ),
      '289d6ad4c73df596dc652392b6519877' => 
      array (
        0 => '340,30',
        1 => '215.409,90',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        13 => '27.216,89',
        9 => '44.777,49',
        14 => '180.181,04',
        39 => '42.688,62',
      ),
      'totalNetto' => '2.103.353,67',
      'totalBrutto' => '2.398.217,71',
      'grandTotal' => '2.398.217,71',
    ),
  ),
);