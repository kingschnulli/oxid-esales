<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => 'b066582f0e874abd9d8447204120cfb5',
      'oxprice' => 134.26,
      'oxvat' => 25,
      'amount' => 597,
    ),
    2 => 
    array (
      'oxid' => 'b194b748eadf53e63136f038e4906d7d',
      'oxprice' => 399.85,
      'oxvat' => 25,
      'amount' => 174,
    ),
    3 => 
    array (
      'oxid' => 'b71e4fbbb744b75bf2ff11c67caea7bb',
      'oxprice' => 287.12,
      'oxvat' => 25,
      'amount' => 531,
    ),
    4 => 
    array (
      'oxid' => 'c4d4d7b184bd452dffd9f97d42b63769',
      'oxprice' => 594.81,
      'oxvat' => 25,
      'amount' => 240,
    ),
    5 => 
    array (
      'oxid' => 'fcb0d9510a318f9d9a307a2f538fa73b',
      'oxprice' => 483.58,
      'oxvat' => 25,
      'amount' => 809,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'b066582f0e874abd9d8447204120cfb5' => 
      array (
        0 => '134,26',
        1 => '80.153,22',
      ),
      'b194b748eadf53e63136f038e4906d7d' => 
      array (
        0 => '399,85',
        1 => '69.573,90',
      ),
      'b71e4fbbb744b75bf2ff11c67caea7bb' => 
      array (
        0 => '287,12',
        1 => '152.460,72',
      ),
      'c4d4d7b184bd452dffd9f97d42b63769' => 
      array (
        0 => '594,81',
        1 => '142.754,40',
      ),
      'fcb0d9510a318f9d9a307a2f538fa73b' => 
      array (
        0 => '483,58',
        1 => '391.216,22',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        25 => '167.231,69',
      ),
      'totalNetto' => '668.926,77',
      'totalBrutto' => '836.158,46',
      'grandTotal' => '836.158,46',
    ),
  ),
);