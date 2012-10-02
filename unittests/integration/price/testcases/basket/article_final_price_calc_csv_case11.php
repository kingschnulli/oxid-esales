<?php
/* 
 * From articlePrice.csv: article final price calculations. 9202 - 1st. Domestic vat 17, foreign vat - 0
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9202,
                'oxprice'                  => 16.2,
                'oxvat'                    => 0,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9202 => array ( '16,20', '16,20' ),
        ),
        'totals' => array (
                'totalBrutto' => '16,20',
                'totalNetto'  => '16,20',
                'vats' => array (
                    0 => '0,00',
                ),
                'grandTotal'  => '16,20'
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