<?php
/* 
 * https://bugs.oxid-esales.com/view.php?id=4425
 * @bug #4425
 */
$aData = array(
    'articles' => array (
        0 => array (
                'oxid'                     => '4425',
                'oxprice'                  => 879,
                'amount'                   => 1,
        ),
    ),
    'discounts' => array (
        0 => array (
                'oxid'         => 'discount10euro',
                'oxaddsum'     => 10,
                'oxaddsumtype' => 'abs',
                'oxamount' => 1,
                'oxamountto' => 99999,
                'oxprice' => 0,
                'oxpriceto' => 0,
                'oxactive' => 1,
                'oxarticles' => array ( 4425 ),
        ),
    ),
    'expected' => array (
        'articles' => array (
                '4425' => array ( '869,00', '869,00' ),
        ),
        'totals' => array (
                'totalBrutto' => '869,00',
                'totalNetto'  => '730,25',
                'vats' => array (
                        '19' => '138,75',
                ),
                'grandTotal'  => '869,00'
        ),
    ),
    'options' => array (
            'config' => array(
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false     
            ),
    )
);