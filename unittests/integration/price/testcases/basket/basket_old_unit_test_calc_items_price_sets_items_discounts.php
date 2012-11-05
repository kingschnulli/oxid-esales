<?php
/* 
 * Testing basket item price calculator also sets items discounts
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'        => 'testarticle',
                'oxprice'     => 19,
                'oxweight'    => 10,
                'oxstock'     => 100,
                'oxstockflag' => 2,
                'amount'      => 1,
                'scaleprices' => array(),
        ),
    ),
    'discounts' => array (
            0 => array (
                    'oxid'        => 'testdiscount0',
                    'oxactive'    => 1,
                    'oxtitle'     => 'Test discount 0',
                    'oxamount'    => 1,
                    'oxamountto'    => 99999,
                    'oxprice'     => 1,
                    'oxpriceto'   => 99999,
                    'oxaddsumtype'=> 'abs',
                    'oxaddsum'    => 5,
            ),
            1 => array (
                    'oxid'        => 'testdiscount1',
                    'oxactive'    => 1,
                    'oxtitle'     => 'Test discount 1',
                    'oxamount'    => 1,
                    'oxamountto'    => 99999,
                    'oxprice'     => 1,
                    'oxpriceto'   => 99999,
                    'oxaddsumtype'=> 'abs',
                    'oxaddsum'    => 7,
            ),
    ),
    'expected' => array (
        'articles' => array (
             'testarticle' => array ( '19,00', '19,00' ),
        ),
        'totals' => array (
            'totalBrutto' => '19,00',
            'totalNetto'  => '5,88',
            'vats' => array (
                19 => '1,12'
            ),
            'discounts' => array(
                    'testdiscount0' => '5,00',
                    'testdiscount1' => '7,00'
                ),
            'grandTotal'  => '7,00'
        ),
    ),
    'options' => array (
        'config' => array(
            'blEnterNetPrice' => false,
            'blShowNetPrice' => false,        
        ),
        'activeCurrencyRate' => 1,
    ),
);