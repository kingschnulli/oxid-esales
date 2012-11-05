<?php
/* 
 * From basketCalc.csv: VII order.
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9200,
                'oxprice'                  => 47.62,
                'oxvat'                    => 0,
                'amount'                   => 1,
        ),
        1 => array (
                'oxid'                     => 9201,
                'oxprice'                  => 91.82,
                'oxvat'                    => 0,
                'amount'                   => 1,
        ),
        2 => array (
                'oxid'                     => 9207,
                'oxprice'                  => 63.03,
                'oxvat'                    => 0,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9200 => array ( '47,62', '47,62' ),
                 9201 => array ( '91,82', '91,82' ),
                 9207 => array ( '63,03', '63,03' ),
        ),
        'totals' => array (
                'totalBrutto' => '202,47',
                'totalNetto'  => '202,47',
                'vats' => array (
                        0 => '0,00',
                ),
                'grandTotal'  => '202,47'
        ),
    ),
    'options' => array (    
        'config' => array(
            'blEnterNetPrice' => false,
            'blShowNetPrice' => false     
        ),
    ),
);