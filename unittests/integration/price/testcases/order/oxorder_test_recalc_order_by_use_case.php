<?php
// Simple order saving, add article, updating
$aData = array (
     'articles' => array (
             0 => array (
                     'oxid'       => '1126',
                     'oxtitle'    => 'Bar-Set ABSINTH',
                     'oxprice'    => 34,
                     'oxvat'      => 19,
                     'oxstock'    => 999,
                     'amount'     => 1,
             ),
             1 => array (
                     'oxid'       => '1127',
                     'oxtitle'    => 'Ice Cubes FLASH',
                     'oxprice'    => 8,
                     'oxvat'      => 19,
                     'oxstock'    => 999,
                     'amount'     => 1,
             ),
     ),
    'categories' => array (
            0 =>  array (
                    'oxid'     => '30e44ab8593023055.23928895',
                    'oxactive' => 1,
                    'oxtitle'  => 'Bar-Equipment',
                    'articles' => ( 1126 )
            ),   
    ),
    'discounts' => array (
            0 => array (
                    'oxid'         => '_testDiscountForArticle',
                    'oxaddsum'     => 50,
                    'oxaddsumtype' => '%',
                    'oxamount'     => 1,
                    'oxamountto'   => 9999,
                    'oxactive'     => 1,
                    'oxarticles'   => array ( 1126, 1127 )
            ),
            1 => array (
                    'oxid'         => '_testDiscountForCategory',
                    'oxaddsum'     => 50,
                    'oxaddsumtype' => '%',
                    'oxamount'     => 1,
                    'oxamountto'   => 9999,
                    'oxactive'     => 1,
                    'oxcategories'   => array ( '30e44ab8593023055.23928895' )
            ),
    ),
    'shipping' => '1b842e732a23255b1.91207751',
    'payment' => 'oxidpayadvance',
    'expected' => array (
        1 => array (
            'articles' => array (
                    '1126' => array ( '17,00', '17,00' ),
                    '1127' => array ( '4,00', '4,00' ),
            ),
            'totals' => array (
                    'totalBrutto' => '21,00',
                    'discount' => '0,00',
                    'totalNetto'  => '17,65',
                    'vats' => array (
                            19 => '3,35'
                    ),
                    'delivery' => array(
                            'brutto' => '0,00',
                    ),
                    'payment' => array(
                            'brutto' => '0,00',
                    ),
                    'grandTotal'  => '21,00',
            ),
        ),
    ),
    'options' => array (
            'config' => array (
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false,
            ),
    ),
);