<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '7b78b2638fd33bb16c78dd888a513023',
      'oxprice' => 636.91,
      'oxvat' => 18,
      'amount' => 844,
    ),
    2 => 
    array (
      'oxid' => 'fac5a2d05bb1667c25bea7b3096250d7',
      'oxprice' => 50.67,
      'oxvat' => 12,
      'amount' => 122,
    ),
    3 => 
    array (
      'oxid' => 'bf04b851c1a23689c6f63d407f4de73c',
      'oxprice' => 560.16,
      'oxvat' => 8,
      'amount' => 331,
    ),
    4 => 
    array (
      'oxid' => 'f67c3b352420f9434683445ce93487ad',
      'oxprice' => 456.67,
      'oxvat' => 12,
      'amount' => 880,
    ),
    5 => 
    array (
      'oxid' => '15682cef77da38f782edbb3ebf6ca025',
      'oxprice' => 588.05,
      'oxvat' => 18,
      'amount' => 326,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '7b78b2638fd33bb16c78dd888a513023' => 
      array (
        0 => '636,91',
        1 => '537.552,04',
      ),
      'fac5a2d05bb1667c25bea7b3096250d7' => 
      array (
        0 => '50,67',
        1 => '6.181,74',
      ),
      'bf04b851c1a23689c6f63d407f4de73c' => 
      array (
        0 => '560,16',
        1 => '185.412,96',
      ),
      'f67c3b352420f9434683445ce93487ad' => 
      array (
        0 => '456,67',
        1 => '401.869,60',
      ),
      '15682cef77da38f782edbb3ebf6ca025' => 
      array (
        0 => '588,05',
        1 => '191.704,30',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        18 => '111.242,49',
        12 => '43.719,79',
        8 => '13.734,29',
      ),
      'totalNetto' => '1.154.024,07',
      'totalBrutto' => '1.322.720,64',
      'grandTotal' => '1.322.720,64',
    ),
  ),
);