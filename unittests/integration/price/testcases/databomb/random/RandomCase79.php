<?php$sInsertMode = 'brutto';
$sViewMode = 'brutto';
$aData = array (
  'articles' => 
  array (
    1 => 
    array (
      'oxid' => '2e89ae891f5d1e3617e66fbf8f639e6a',
      'oxprice' => 165.11,
      'oxvat' => 0,
      'amount' => 837,
    ),
    2 => 
    array (
      'oxid' => '2289e0fc7e75cfc6266709dfb4ee1d9e',
      'oxprice' => 456.39,
      'oxvat' => 34,
      'amount' => 856,
    ),
    3 => 
    array (
      'oxid' => 'b7ec9b7041cb52264278afe8d38c84ba',
      'oxprice' => 209.8,
      'oxvat' => 0,
      'amount' => 253,
    ),
    4 => 
    array (
      'oxid' => '16e5af2aedb2c2fda937ea84fd8f3f9f',
      'oxprice' => 474.24,
      'oxvat' => 0,
      'amount' => 274,
    ),
    5 => 
    array (
      'oxid' => '094b4c9e7fec827cdaf192bda661a2f1',
      'oxprice' => 636.01,
      'oxvat' => 12,
      'amount' => 195,
    ),
    6 => 
    array (
      'oxid' => '260a388db5267b870a6c1b608e246e86',
      'oxprice' => 226.18,
      'oxvat' => 0,
      'amount' => 674,
    ),
    7 => 
    array (
      'oxid' => '72c541b89e101ef8e0b1853c46b1f3cd',
      'oxprice' => 475.43,
      'oxvat' => 0,
      'amount' => 16,
    ),
    8 => 
    array (
      'oxid' => '4a1cef58a8e233a7f30195d72a6c1426',
      'oxprice' => 489.86,
      'oxvat' => 0,
      'amount' => 727,
    ),
    9 => 
    array (
      'oxid' => '91afdd804497ca0b7306e1d5d0997bb0',
      'oxprice' => 643.6,
      'oxvat' => 34,
      'amount' => 753,
    ),
    10 => 
    array (
      'oxid' => '1289f1a5ed8ce0a4e5aefc3f0265b796',
      'oxprice' => 630.73,
      'oxvat' => 0,
      'amount' => 180,
    ),
    11 => 
    array (
      'oxid' => '3ea64b9adf7d30f47a64579703d6d92e',
      'oxprice' => 226.37,
      'oxvat' => 12,
      'amount' => 548,
    ),
    12 => 
    array (
      'oxid' => 'bae8d07345b29f5c1c7159a0a00564dc',
      'oxprice' => 324.51,
      'oxvat' => 12,
      'amount' => 121,
    ),
    13 => 
    array (
      'oxid' => '147434007886282bef1c91a2bd0745e2',
      'oxprice' => 943.66,
      'oxvat' => 8,
      'amount' => 336,
    ),
    14 => 
    array (
      'oxid' => '094e97d37741c26e850f411d5f646fc5',
      'oxprice' => 367.93,
      'oxvat' => 8,
      'amount' => 610,
    ),
  ),
  'discounts' => 
  array (
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      '2e89ae891f5d1e3617e66fbf8f639e6a' => 
      array (
        0 => '165,11',
        1 => '138.197,07',
      ),
      '2289e0fc7e75cfc6266709dfb4ee1d9e' => 
      array (
        0 => '456,39',
        1 => '390.669,84',
      ),
      'b7ec9b7041cb52264278afe8d38c84ba' => 
      array (
        0 => '209,80',
        1 => '53.079,40',
      ),
      '16e5af2aedb2c2fda937ea84fd8f3f9f' => 
      array (
        0 => '474,24',
        1 => '129.941,76',
      ),
      '094b4c9e7fec827cdaf192bda661a2f1' => 
      array (
        0 => '636,01',
        1 => '124.021,95',
      ),
      '260a388db5267b870a6c1b608e246e86' => 
      array (
        0 => '226,18',
        1 => '152.445,32',
      ),
      '72c541b89e101ef8e0b1853c46b1f3cd' => 
      array (
        0 => '475,43',
        1 => '7.606,88',
      ),
      '4a1cef58a8e233a7f30195d72a6c1426' => 
      array (
        0 => '489,86',
        1 => '356.128,22',
      ),
      '91afdd804497ca0b7306e1d5d0997bb0' => 
      array (
        0 => '643,60',
        1 => '484.630,80',
      ),
      '1289f1a5ed8ce0a4e5aefc3f0265b796' => 
      array (
        0 => '630,73',
        1 => '113.531,40',
      ),
      '3ea64b9adf7d30f47a64579703d6d92e' => 
      array (
        0 => '226,37',
        1 => '124.050,76',
      ),
      'bae8d07345b29f5c1c7159a0a00564dc' => 
      array (
        0 => '324,51',
        1 => '39.265,71',
      ),
      '147434007886282bef1c91a2bd0745e2' => 
      array (
        0 => '943,66',
        1 => '317.069,76',
      ),
      '094e97d37741c26e850f411d5f646fc5' => 
      array (
        0 => '367,93',
        1 => '224.437,30',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        0 => '0,00',
        34 => '222.091,21',
        12 => '30.786,26',
        8 => '40.111,63',
      ),
      'totalNetto' => '2.362.087,07',
      'totalBrutto' => '2.655.076,17',
      'grandTotal' => '2.655.076,17',
    ),
  ),
);