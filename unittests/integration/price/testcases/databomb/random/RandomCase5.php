<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '75df8122b5b18ec54694a29fdc847bf3',
      'oxprice' => 367.14,
      'oxvat' => 22,
      'amount' => 409,
    ),
    2 => 
    array (
      'oxid' => '77830482da3a762feff1e1a5cc0fb44e',
      'oxprice' => 117.24,
      'oxvat' => 22,
      'amount' => 291,
    ),
    3 => 
    array (
      'oxid' => '9a85d03a4028b5af9ff64d84bbfb2ba8',
      'oxprice' => 460.67,
      'oxvat' => 20,
      'amount' => 245,
    ),
    4 => 
    array (
      'oxid' => '6cbc8d446b4601d77c4e47c0481ffff4',
      'oxprice' => 933.48,
      'oxvat' => 7,
      'amount' => 717,
    ),
    5 => 
    array (
      'oxid' => '5a42935d91fc81473bbd5a5abf4d842b',
      'oxprice' => 613.13,
      'oxvat' => 22,
      'amount' => 408,
    ),
    6 => 
    array (
      'oxid' => '0ef3f6def056e452d9891c6b745eedf0',
      'oxprice' => 414.27,
      'oxvat' => 22,
      'amount' => 403,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '75df8122b5b18ec54694a29fdc847bf3' => 
      array (
        0 => '367,14',
        1 => '150.160,26',
      ),
      '77830482da3a762feff1e1a5cc0fb44e' => 
      array (
        0 => '117,24',
        1 => '34.116,84',
      ),
      '9a85d03a4028b5af9ff64d84bbfb2ba8' => 
      array (
        0 => '460,67',
        1 => '112.864,15',
      ),
      '6cbc8d446b4601d77c4e47c0481ffff4' => 
      array (
        0 => '933,48',
        1 => '669.305,16',
      ),
      '5a42935d91fc81473bbd5a5abf4d842b' => 
      array (
        0 => '613,13',
        1 => '250.157,04',
      ),
      '0ef3f6def056e452d9891c6b745eedf0' => 
      array (
        0 => '414,27',
        1 => '166.950,81',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        22 => '108.446,47',
        20 => '18.810,69',
        7 => '43.786,32',
      ),
      'totalNetto' => '1.212.510,78',
      'totalBrutto' => '1.383.554,26',
      'grandTotal' => '1.383.554,26',
    ),
  ),
);