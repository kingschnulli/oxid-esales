<?php
/* 
 * #1456: Discount validity is wrong if article in basket has Scale Prices
 */
$aData = array(
    'articles' => array (
        0 => array (
            'oxid'       => 'testarticle',
            'oxprice'    => 12.95,
            'amount'     => 1,
            'scaleprices' => array(
                    'oxaddabs'     => 11.95,
                    'oxamount'     => 2,
                    'oxamountto'   => 2,
                    'oxartid'      => 'testarticle'
            ),
        ),
    ),
    'discounts' => array (
        0 => array (
            'oxid'         => '_testDiscount',
            'oxactive'     => 1,
            'oxtitle'      => 'new discount',
            'oxprice'      => 12,
            'oxpriceto'    => 24.99,
            'oxaddsumtype' => 'abs',
            'oxaddsum'     => 3
        ),
    ),
    'expected' => array (
        'articles' => array (
             'testarticle' => array ( '12,95', '12,95' ),
        ),
        'totals' => array (
            'totalBrutto' => '12,95',
            'totalNetto'  => '8,36',
            'vats' => array (
                19 => '1,59'
            ),
            'discounts' => array(
                    '_testDiscount' => '3,00'
                ),
            'grandTotal'  => '9,95'
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