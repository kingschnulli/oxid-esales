<?php
/* 
 * From articlePrice.csv: article final price calculations. 9209 - 1st
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9209,
                'oxprice'                  => 42.36,
                'oxvat'                    => 18,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9209 => array ( '24,57', '24,57' ),
        ),
        'totals' => array (
                'totalBrutto' => '24,57',
                'totalNetto'  => '20,82',
                'vats' => array (
                        18 => '3,75',
                ),
                'grandTotal'  => '24,57'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false      
        ),
        'activeCurrencyRate' => 0.58,
    ),
);