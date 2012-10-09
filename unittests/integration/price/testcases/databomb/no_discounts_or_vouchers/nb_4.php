<?php$aData = array (
  'user' => 
  array (
    'oxactive' => 1,
    'oxusername' => 'databomb_user_4',
  ),
  'articles' => 
  array (
    0 => 
    array (
      'oxid' => 'f09b5a1b3037bdd815a8e81504b2a',
      'oxprice' => 782.5,
      'oxvat' => 12,
      'amount' => 186,
    ),
    1 => 
    array (
      'oxid' => '28ca206fe85f6d918aac3a433b5d1',
      'oxprice' => 439.79,
      'oxvat' => 12,
      'amount' => 342,
    ),
    2 => 
    array (
      'oxid' => '3f845cd29dfef87f880b22f117e17',
      'oxprice' => 585.29,
      'oxvat' => 12,
      'amount' => 611,
    ),
    3 => 
    array (
      'oxid' => '8726b2f8243f0414e5f739ba726f6',
      'oxprice' => 201.86,
      'oxvat' => 12,
      'amount' => 313,
    ),
    4 => 
    array (
      'oxid' => '54cbf6a1ec24a67b15226cf9a8e54',
      'oxprice' => 908.11,
      'oxvat' => 12,
      'amount' => 881,
    ),
  ),
  'costs' => 
  array (
    'wrapping' => 
    array (
      0 => 
      array (
        'oxtype' => 'WRAP',
        'oxprice' => 2,
        'oxactive' => 1,
        'oxarticles' => 
        array (
          0 => 'f09b5a1b3037bdd815a8e81504b2a',
          1 => '28ca206fe85f6d918aac3a433b5d1',
          2 => '3f845cd29dfef87f880b22f117e17',
          3 => '8726b2f8243f0414e5f739ba726f6',
          4 => '54cbf6a1ec24a67b15226cf9a8e54',
        ),
      ),
      1 => 
      array (
        'oxtype' => 'WRAP',
        'oxprice' => 54,
        'oxactive' => 1,
        'oxarticles' => 
        array (
          0 => 'f09b5a1b3037bdd815a8e81504b2a',
          1 => '28ca206fe85f6d918aac3a433b5d1',
          2 => '3f845cd29dfef87f880b22f117e17',
          3 => '8726b2f8243f0414e5f739ba726f6',
          4 => '54cbf6a1ec24a67b15226cf9a8e54',
        ),
      ),
      2 => 
      array (
        'oxtype' => 'WRAP',
        'oxprice' => 57,
        'oxactive' => 1,
        'oxarticles' => 
        array (
          0 => 'f09b5a1b3037bdd815a8e81504b2a',
          1 => '28ca206fe85f6d918aac3a433b5d1',
          2 => '3f845cd29dfef87f880b22f117e17',
          3 => '8726b2f8243f0414e5f739ba726f6',
          4 => '54cbf6a1ec24a67b15226cf9a8e54',
        ),
      ),
    ),
    'payment' => 
    array (
      0 => 
      array (
        'oxaddsumtype' => 'abs',
        'oxaddsum' => 23,
        'oxactive' => 1,
        'oxchecked' => 1,
        'oxfromamount' => 0,
        'oxtoamount' => 1000000,
      ),
      1 => 
      array (
        'oxaddsumtype' => 'abs',
        'oxaddsum' => 80,
        'oxactive' => 1,
        'oxchecked' => 1,
        'oxfromamount' => 0,
        'oxtoamount' => 1000000,
      ),
      2 => 
      array (
        'oxaddsumtype' => 'abs',
        'oxaddsum' => 63,
        'oxactive' => 1,
        'oxchecked' => 1,
        'oxfromamount' => 0,
        'oxtoamount' => 1000000,
      ),
    ),
    'delivery' => 
    array (
      0 => 
      array (
        'oxaddsumtype' => 'abs',
        'oxaddsum' => 66,
        'oxactive' => 1,
        'oxdeltype' => 'p',
        'oxfinalize' => 0,
        'oxparam' => 0,
        'oxparamend' => 999999999,
        'oxfixed' => 0,
      ),
      1 => 
      array (
        'oxaddsumtype' => '%',
        'oxaddsum' => 55,
        'oxactive' => 1,
        'oxdeltype' => 'p',
        'oxfinalize' => 0,
        'oxparam' => 0,
        'oxparamend' => 999999999,
        'oxfixed' => 0,
      ),
      2 => 
      array (
        'oxaddsumtype' => 'abs',
        'oxaddsum' => 61,
        'oxactive' => 1,
        'oxdeltype' => 'p',
        'oxfinalize' => 0,
        'oxparam' => 0,
        'oxparamend' => 999999999,
        'oxfixed' => 0,
      ),
    ),
  ),
  'options' => 
  array (
    'config' => 
    array (
      'blEnterNetPrice' => true,
      'blShowNetPrice' => false,
    ),
    'activeCurrencyRate' => 1,
  ),
  'expected' => 
  array (
    'articles' => 
    array (
      'f09b5a1b3037bdd815a8e81504b2a' => 
      array (
        0 => '876,40',
        1 => '163.010,40',
      ),
      '28ca206fe85f6d918aac3a433b5d1' => 
      array (
        0 => '492,56',
        1 => '168.455,52',
      ),
      '3f845cd29dfef87f880b22f117e17' => 
      array (
        0 => '655,52',
        1 => '400.522,72',
      ),
      '8726b2f8243f0414e5f739ba726f6' => 
      array (
        0 => '226,08',
        1 => '70.763,04',
      ),
      '54cbf6a1ec24a67b15226cf9a8e54' => 
      array (
        0 => '1.017,08',
        1 => '896.047,48',
      ),
    ),
    'totals' => 
    array (
      'vats' => 
      array (
        12 => '182.014,20',
      ),
      'wrapping' => 
      array (
        'brutto' => '132.981,00',
        'netto' => false,
        'vat' => false,
      ),
      'delivery' => 
      array (
        'brutto' => '934.466,54',
        'netto' => '834.345,13',
        'vat' => '100.121,42',
      ),
      'payment' => 
      array (
        'brutto' => '23,00',
        'netto' => '20,54',
        'vat' => '2,46',
      ),
      'voucher' => 
      array (
        'brutto' => '0,00',
      ),
      'totalNetto' => '1.516.784,96',
      'totalBrutto' => '1.698.799,16',
      'grandTotal' => '2.766.269,70',
    ),
  ),
);