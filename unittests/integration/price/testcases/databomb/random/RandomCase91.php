<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '4dff5f45583bb4cfce6da1dd30c05193',
      'oxprice' => 413.48,
      'oxvat' => 42,
      'amount' => 783,
    ),
    2 => 
    array (
      'oxid' => 'e35e78b15cb69f0b57deab540dd66188',
      'oxprice' => 159.97,
      'oxvat' => 23,
      'amount' => 998,
    ),
    3 => 
    array (
      'oxid' => '8ea413961813cb069cbdea391d7a1cd9',
      'oxprice' => 737.15,
      'oxvat' => 42,
      'amount' => 549,
    ),
    4 => 
    array (
      'oxid' => '235a56a24f6c0cd3dfca30226371f653',
      'oxprice' => 973.78,
      'oxvat' => 38,
      'amount' => 680,
    ),
    5 => 
    array (
      'oxid' => '8447630eab1b5a4ed811e872b89111fb',
      'oxprice' => 993.36,
      'oxvat' => 38,
      'amount' => 16,
    ),
    6 => 
    array (
      'oxid' => 'de4dd1ff25da1e0b1fe9ed47a4cf59da',
      'oxprice' => 949.82,
      'oxvat' => 28,
      'amount' => 307,
    ),
    7 => 
    array (
      'oxid' => 'e6eb23e4d94e3eac0ec7873805ee815c',
      'oxprice' => 302.65,
      'oxvat' => 23,
      'amount' => 743,
    ),
    8 => 
    array (
      'oxid' => '085f2372ddc6cc50d166390677805537',
      'oxprice' => 138.64,
      'oxvat' => 38,
      'amount' => 727,
    ),
    9 => 
    array (
      'oxid' => 'e802e47936ca3e19962808028dd9e0db',
      'oxprice' => 32.42,
      'oxvat' => 23,
      'amount' => 495,
    ),
    10 => 
    array (
      'oxid' => '11e5c5794c1b889ad88c9894fcd2beae',
      'oxprice' => 306.23,
      'oxvat' => 38,
      'amount' => 706,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '4dff5f45583bb4cfce6da1dd30c05193' => 
      array (
        0 => '413,48',
        1 => '323.754,84',
      ),
      'e35e78b15cb69f0b57deab540dd66188' => 
      array (
        0 => '159,97',
        1 => '159.650,06',
      ),
      '8ea413961813cb069cbdea391d7a1cd9' => 
      array (
        0 => '737,15',
        1 => '404.695,35',
      ),
      '235a56a24f6c0cd3dfca30226371f653' => 
      array (
        0 => '973,78',
        1 => '662.170,40',
      ),
      '8447630eab1b5a4ed811e872b89111fb' => 
      array (
        0 => '993,36',
        1 => '15.893,76',
      ),
      'de4dd1ff25da1e0b1fe9ed47a4cf59da' => 
      array (
        0 => '949,82',
        1 => '291.594,74',
      ),
      'e6eb23e4d94e3eac0ec7873805ee815c' => 
      array (
        0 => '302,65',
        1 => '224.868,95',
      ),
      '085f2372ddc6cc50d166390677805537' => 
      array (
        0 => '138,64',
        1 => '100.791,28',
      ),
      'e802e47936ca3e19962808028dd9e0db' => 
      array (
        0 => '32,42',
        1 => '16.047,90',
      ),
      '11e5c5794c1b889ad88c9894fcd2beae' => 
      array (
        0 => '306,23',
        1 => '216.198,38',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        42 => '215.457,10',
        23 => '74.902,76',
        38 => '274.000,33',
        28 => '63.786,35',
      ),
      'totalNetto' => '1.787.519,12',
      'totalBrutto' => '2.415.665,66',
      'grandTotal' => '2.415.665,66',
    ),
  ),
);