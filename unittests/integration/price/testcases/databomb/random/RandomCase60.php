<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '59dc6c38cc43d27542d74493083fecb3',
      'oxprice' => 624.36,
      'oxvat' => 25,
      'amount' => 937,
    ),
    2 => 
    array (
      'oxid' => '4bd5be9ff66029d3e607c7098cf50fcb',
      'oxprice' => 303.46,
      'oxvat' => 25,
      'amount' => 900,
    ),
    3 => 
    array (
      'oxid' => '36dfefb7935141a0b96931a659c5840f',
      'oxprice' => 968.61,
      'oxvat' => 25,
      'amount' => 251,
    ),
    4 => 
    array (
      'oxid' => '67db4288488a9a0869e2bc6139b64424',
      'oxprice' => 554.8,
      'oxvat' => 25,
      'amount' => 224,
    ),
    5 => 
    array (
      'oxid' => '778535772aaa3cd0db32e7c29dc61bbd',
      'oxprice' => 872.8,
      'oxvat' => 25,
      'amount' => 7,
    ),
    6 => 
    array (
      'oxid' => '5d93829cb5874f8211c42ef4e77c9f18',
      'oxprice' => 486.44,
      'oxvat' => 25,
      'amount' => 955,
    ),
    7 => 
    array (
      'oxid' => 'd22a83aa7653bd1e2b860b8fb98a44a1',
      'oxprice' => 145.25,
      'oxvat' => 25,
      'amount' => 74,
    ),
    8 => 
    array (
      'oxid' => '73420b0e28590bb420d05f632b8e6727',
      'oxprice' => 102.24,
      'oxvat' => 25,
      'amount' => 703,
    ),
    9 => 
    array (
      'oxid' => 'c16148a9485b3986b18a845d8c3f1ce2',
      'oxprice' => 278.73,
      'oxvat' => 25,
      'amount' => 808,
    ),
    10 => 
    array (
      'oxid' => '177b732cc476b870e09039155eeb5eab',
      'oxprice' => 526.55,
      'oxvat' => 25,
      'amount' => 521,
    ),
    11 => 
    array (
      'oxid' => '099250ea1b9c26a8a6bdbb6c5be4f04d',
      'oxprice' => 642.55,
      'oxvat' => 25,
      'amount' => 679,
    ),
    12 => 
    array (
      'oxid' => 'e344e215c81c08cc7b42ef688e06003e',
      'oxprice' => 493.5,
      'oxvat' => 25,
      'amount' => 107,
    ),
    13 => 
    array (
      'oxid' => 'dd1b0817122856d93f90d04a3235e025',
      'oxprice' => 1.31,
      'oxvat' => 25,
      'amount' => 581,
    ),
    14 => 
    array (
      'oxid' => '8ae9140c8622802660cfbcddcd113aa4',
      'oxprice' => 410.44,
      'oxvat' => 25,
      'amount' => 407,
    ),
    15 => 
    array (
      'oxid' => '0d03e8e92c262aab03acf290c01056bb',
      'oxprice' => 539.99,
      'oxvat' => 25,
      'amount' => 628,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '59dc6c38cc43d27542d74493083fecb3' => 
      array (
        0 => '624,36',
        1 => '585.025,32',
      ),
      '4bd5be9ff66029d3e607c7098cf50fcb' => 
      array (
        0 => '303,46',
        1 => '273.114,00',
      ),
      '36dfefb7935141a0b96931a659c5840f' => 
      array (
        0 => '968,61',
        1 => '243.121,11',
      ),
      '67db4288488a9a0869e2bc6139b64424' => 
      array (
        0 => '554,80',
        1 => '124.275,20',
      ),
      '778535772aaa3cd0db32e7c29dc61bbd' => 
      array (
        0 => '872,80',
        1 => '6.109,60',
      ),
      '5d93829cb5874f8211c42ef4e77c9f18' => 
      array (
        0 => '486,44',
        1 => '464.550,20',
      ),
      'd22a83aa7653bd1e2b860b8fb98a44a1' => 
      array (
        0 => '145,25',
        1 => '10.748,50',
      ),
      '73420b0e28590bb420d05f632b8e6727' => 
      array (
        0 => '102,24',
        1 => '71.874,72',
      ),
      'c16148a9485b3986b18a845d8c3f1ce2' => 
      array (
        0 => '278,73',
        1 => '225.213,84',
      ),
      '177b732cc476b870e09039155eeb5eab' => 
      array (
        0 => '526,55',
        1 => '274.332,55',
      ),
      '099250ea1b9c26a8a6bdbb6c5be4f04d' => 
      array (
        0 => '642,55',
        1 => '436.291,45',
      ),
      'e344e215c81c08cc7b42ef688e06003e' => 
      array (
        0 => '493,50',
        1 => '52.804,50',
      ),
      'dd1b0817122856d93f90d04a3235e025' => 
      array (
        0 => '1,31',
        1 => '761,11',
      ),
      '8ae9140c8622802660cfbcddcd113aa4' => 
      array (
        0 => '410,44',
        1 => '167.049,08',
      ),
      '0d03e8e92c262aab03acf290c01056bb' => 
      array (
        0 => '539,99',
        1 => '339.113,72',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        25 => '654.876,98',
      ),
      'totalNetto' => '2.619.507,92',
      'totalBrutto' => '3.274.384,90',
      'grandTotal' => '3.274.384,90',
    ),
  ),
);