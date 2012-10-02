<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '4fc8548fc98dd8b6d9df4d0dba44dfbf',
      'oxprice' => 663.57,
      'oxvat' => 16,
      'amount' => 454,
    ),
    2 => 
    array (
      'oxid' => 'bedc613113e360a180ab18d47f681293',
      'oxprice' => 183.53,
      'oxvat' => 0,
      'amount' => 883,
    ),
    3 => 
    array (
      'oxid' => '357b281c7f5b1d1f569f03949a21cb0f',
      'oxprice' => 109.21,
      'oxvat' => 13,
      'amount' => 269,
    ),
    4 => 
    array (
      'oxid' => '53278276b74d2da50c98feb3daf340ea',
      'oxprice' => 855.84,
      'oxvat' => 16,
      'amount' => 288,
    ),
    5 => 
    array (
      'oxid' => '5f998eb078202c5e2fd9b9bae44e0cec',
      'oxprice' => 173.91,
      'oxvat' => 16,
      'amount' => 134,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '4fc8548fc98dd8b6d9df4d0dba44dfbf' => 
      array (
        0 => '663,57',
        1 => '301.260,78',
      ),
      'bedc613113e360a180ab18d47f681293' => 
      array (
        0 => '183,53',
        1 => '162.056,99',
      ),
      '357b281c7f5b1d1f569f03949a21cb0f' => 
      array (
        0 => '109,21',
        1 => '29.377,49',
      ),
      '53278276b74d2da50c98feb3daf340ea' => 
      array (
        0 => '855,84',
        1 => '246.481,92',
      ),
      '5f998eb078202c5e2fd9b9bae44e0cec' => 
      array (
        0 => '173,91',
        1 => '23.303,94',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        16 => '78.765,05',
        0 => '0,00',
        13 => '3.379,71',
      ),
      'totalNetto' => '680.336,36',
      'totalBrutto' => '762.481,12',
      'grandTotal' => '762.481,12',
    ),
  ),
);