<?php
/* 
 * From basketCalc.csv: IV order.
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9202,
                'oxprice'                  => 15.93,
                'oxvat'                    => 15,
                'amount'                   => 21,
        ),
        1 => array (
                'oxid'                     => 9208,
                'oxprice'                  => 70.87,
                'oxvat'                    => 15,
                'amount'                   => 9,
        ),
        2 => array (
                'oxid'                     => 9213,
                'oxprice'                  => 25.86,
                'oxvat'                    => 0,
                'amount'                   => 10,
        ),
        3 => array (
                'oxid'                     => 9216,
                'oxprice'                  => 48.25,
                'oxvat'                    => 0,
                'amount'                   => 4,
        ),
        4 => array (
                'oxid'                     => 9218,
                'oxprice'                  => 58.09,
                'oxvat'                    => 15,
                'amount'                   => 5,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9202 => array ( '15,93', '334,53' ),
                 9208 => array ( '70,87', '637,83' ),
                 9213 => array ( '25,86', '258,60' ),
                 9216 => array ( '48,25', '193,00' ),
                 9218 => array ( '58,09', '290,45' ),
        ),
        'totals' => array (
                'totalBrutto' => '1.714,41',
                'totalNetto'  => '1.549,70',
                'vats' => array (
                        0 => '0,00',
                        15 => '164,71'
                ),
                'grandTotal'  => '1.714,41'
        ),
    ),
    'options' => array (    
        'config' => array(
            'blEnterNetPrice' => false,
            'blShowNetPrice' => false     
        ),
    ),
);