<?php
/* 
 * From basketCalc.csv: Uneven amounts order.
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9000,
                'oxprice'                  => 50.01,
                'oxvat'                    => 17,
                'amount'                   => 3.30,
        ),
        1 => array (
                'oxid'                     => 9201,
                'oxprice'                  => 1.00,
                'oxvat'                    => 17,
                'amount'                   => 0.33,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9000 => array ( '50,01', '165,03' ),
                 9201 => array ( '1,00', '0,33' ),
        ),
        'totals' => array (
                'totalBrutto' => '165,36',
                'totalNetto'  => '141,33',
                'vats' => array (
                        17 => '24,03',
                ),
                'grandTotal'  => '165,36'
        ),
    ),
    'options' => array (    
        'config' => array( 
            'blAllowUnevenAmounts' => true,
            'blEnterNetPrice' => false,
            'blShowNetPrice' => false,
         ),
    ),
);