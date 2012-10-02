<?php
/* 
 * From articlePrice.csv: article final price calculations. 9203 - 1st
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9203,
                'oxprice'                  => 29.99,
                'oxvat'                    => 19,
                'amount'                   => 1,
        ),
    ),
    'discounts' => array (
        0 => array (
                'oxid'         => 'abs_discount_for_9203',
                'oxaddsum'     => 2.01,
                'oxaddsumtype' => 'abs',
                'oxamount' => 0,
                'oxamountto' => 99999,
                'oxactive' => 1,
                'oxarticles' => array( 9203 ),
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9203 => array ( '33,68', '33,68' ),
        ),
        'totals' => array (
                'totalBrutto' => '33,68',
                'totalNetto'  => '28,30',
                'vats' => array (
                        19 => '5,38',
                ),
                'grandTotal'  => '33,68'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => true,
                'blShowNetPrice' => true,
        ),
        'activeCurrencyRate' => 1,
    ),
);