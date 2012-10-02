<?php
/* 
 * From articlePrice.csv: article final price calculations. 9201 - 2nd
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9201,
                'oxprice'                  => 77.9,
                'oxvat'                    => 17,
                'amount'                   => 1,
        ),
    ),
    'discounts' => array (
        0 => array (
                'oxid'         => 'abs_discount_for_9201',
                'oxaddsum'     => 5.05,
                'oxaddsumtype' => 'abs',
                'oxamount' => 0,
                'oxamountto' => 99999,
                'oxactive' => 1,
                'oxarticles' => array( 9201 ),
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9201 => array ( '49,54', '49,54' ),
        ),
        'totals' => array (
                'totalBrutto' => '49,54',
                'totalNetto'  => '42,34',
                'vats' => array (
                        17 => '7,20',
                ),
                'grandTotal'  => '49,54'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false
        ),
        'activeCurrencyRate' => 0.68,
    ),
);