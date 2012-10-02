<?php
/* 
 * From articlePrice.csv: article final price calculations. 9201 - 1st
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9201,
                'oxprice'                  => 66.58,
                'oxvat'                    => 17,
                'amount'                   => 1,
        ),
    ),
    'discounts' => array (
        0 => array (
                'oxid'         => 'abs_discount_for_9201',
                'oxaddsum'     => 4.32,
                'oxaddsumtype' => 'abs',
                'oxamount' => 0,
                'oxamountto' => 99999,
                'oxactive' => 1,
                'oxarticles' => array( 9201 ),
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9201 => array ( '73,58', '73,58' ),
        ),
        'totals' => array (
                'totalBrutto' => '73,58',
                'totalNetto'  => '62,89',
                'vats' => array (
                    17 => '10,69',
                ),
                'grandTotal'  => '73,58'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => true,
                'blShowNetPrice' => false,
        ),
        'activeCurrencyRate' => 1,
    ),
);