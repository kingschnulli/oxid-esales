<?php
/* 
 * From articlePrice.csv: article final price calculations. 9200 - 1st
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
                 9200 => array ( '87,00', '87,00' ),
        ),
        'totals' => array (
                'totalBrutto' => '87,00',
                'totalNetto'  => '74,36',
                'vats' => array (
                        17 => '12,64',
                ),
                'grandTotal'  => '87,00'
        ),
    ),
    'options' => array (    
        'config' => array(
            'blEnterNetPrice' => false,
            'blViewNetPrice' => false,      
        ),
        'activeCurrencyRate' => 1,
    ),
);