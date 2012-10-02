<?php
/* 
 * From articlePrice.csv: article final price calculations. 9200 - 3rd
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9200,
                'oxprice'                  => 74.36,
                'oxvat'                    => 17,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9200 => array ( '127,89', '127,89' ),
        ),
        'totals' => array (
                'totalBrutto' => '127,89',
                'totalNetto'  => '109,31',
                'vats' => array (
                        17 => '18,58',
                ),
                'grandTotal'  => '127,89'
        ),
    ),
    'options' => array (    
        'config' => array(
                'blEnterNetPrice' => true,
                'blShowNetPrice' => false      
        ),
        'activeCurrencyRate' => 1.47,
    ),
);