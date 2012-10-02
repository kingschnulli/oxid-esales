<?php
/* 
 * From articlePrice.csv: article final price calculations. 9207 - 1st
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9207,
                'oxprice'                  => 45.5,
                'oxvat'                    => 19,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9207 => array ( '45,50', '45,50' ),
        ),
        'totals' => array (
                'totalBrutto' => '45,50',
                'totalNetto'  => '38,24',
                'vats' => array (
                        19 => '7,26',
                ),
                'grandTotal'  => '45,50'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false
        ),
        'activeCurrencyRate' => 1,
    ),
);