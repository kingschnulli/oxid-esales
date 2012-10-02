<?php
/* @bug #3587: single product discount for basket */
$aData = array (
    'articles' => array (
         0 => array (
                 'oxid'                     => '3587',
                 'oxtitle'                  => 'newspaper',
                 'oxprice'                  => 2.98,
                 'amount'                   => 200,
         ),
     ),
    'discounts' => array (
        0 => array (
                'oxid'         => 'discount2forBasket',
                'oxaddsum'     => 2,
                'oxaddsumtype' => '%',
                'oxamount' => 1,
                'oxamountto' => 99999,
                'oxactive' => 1,
                // for specific article
                'oxarticles' => array ( '3587' )
        ),
    ),
    'costs' => array(),
    'expected' => array (
        'articles' => array (
                '3587' => array ( '2,92', '584,00' ),
        ),
        'totals' => array (
                'totalBrutto' => '584,00',
                'totalNetto'  => '490,76',
                'vats' => array (
                        '19' => '93,24'
                ),
                'grandTotal'  => '584,00'
        ),
    ),
    'options' => array (
            'config' => array (
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false,
            ),
    )
);