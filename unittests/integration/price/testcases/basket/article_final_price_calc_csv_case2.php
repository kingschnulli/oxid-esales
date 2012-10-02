<?php
/* 
 * From articlePrice.csv: article final price calculations. 9200 - 2nd
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => 9200,
                'oxprice'                  => 87,
                'oxvat'                    => 17,
                'amount'                   => 1,
        ),
    ),
    'expected' => array (
        'articles' => array (
                 9200 => array ( '59,16', '59,16' ),
        ),
        'totals' => array (
                'totalBrutto' => '59,16',
                'totalNetto'  => '50,56',
                'vats' => array (
                        17 => '8,60',
                ),
                'grandTotal'  => '59,16'
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