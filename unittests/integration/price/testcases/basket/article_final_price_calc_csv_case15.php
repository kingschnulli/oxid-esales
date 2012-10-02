<?php
/* 
 * From articlePrice.csv: article final price calculations. 9206 - 1st
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9206,
                'oxprice'                  => 103,
                'oxvat'                    => 19,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9206 => array ( '103,00', '103,00' ),
        ),
        'totals' => array (
                'totalBrutto' => '103,00',
                'totalNetto'  => '86,55',
                'vats' => array (
                        19 => '16,45',
                ),
                'grandTotal'  => '103,00'
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