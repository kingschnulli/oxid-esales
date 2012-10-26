<?php
/* 
 * From basketCalc.csv: VI order.
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9200,
                'oxprice'                  => 87.00,
                'oxvat'                    => 17,
                'amount'                   => 2008,
        ),
        1 => array (
                'oxid'                     => 9201,
                'oxprice'                  => 72.85,
                'oxvat'                    => 17,
                'amount'                   => 369,
        ),
        2 => array (
                'oxid'                     => 9207,
                'oxprice'                  => 45.50,
                'oxvat'                    => 19,
                'amount'                   => 1698,
        ),
        3 => array (
                'oxid'                     => 9213,
                'oxprice'                  => 30.77,
                'oxvat'                    => 19,
                'amount'                   => 3665,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9200 => array ( '87,00', '174.696,00' ),
                 9201 => array ( '72,85', '26.881,65' ),
                 9207 => array ( '45,50', '77.259,00' ),
                 9213 => array ( '30,77', '112.772,05' ),
        ),
        'totals' => array (
                'totalBrutto' => '391.608,70',
                'totalNetto'  => '331.978,55',
                'vats' => array (
                        17 => '29.289,06',
                        19 => '30.341,09',
                ),
                'grandTotal'  => '391.608,70'
        ),
    ),
    'options' => array (    
        'config' => array(
            'blEnterNetPrice' => false,
            'blShowNetPrice' => false     
        ),
    ),
);