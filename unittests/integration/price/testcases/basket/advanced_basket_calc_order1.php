<?php
/*
 * From advBasketCalc.csv: Complex order calculation I order.
 */
$aData = array(
    'articles' => array (
        0 => array (
            'oxid'                     => 9001,
            'oxprice'                  => 100,
            'oxvat'                    => 19,
            'amount'                   => 33,
        ),
        1 => array (
            'oxid'                     => 9002,
            'oxprice'                  => 66,
            'oxvat'                    => 19,
            'amount'                   => 16,
        ),
    ),
    'discounts' => array (
        0 => array (
            'oxid'         => 'shopdiscount5for9001',
            'oxaddsum'     => 5,
            'oxaddsumtype' => 'abs',
            'oxamount' => 0,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9001 ),
        ),
        1 => array (
            'oxid'         => 'shopdiscount5for9002',
            'oxaddsum'     => 5,
            'oxaddsumtype' => '%',
            'oxamount' => 0,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9002 ),
        ),
        2 => array (
            'oxid'         => 'basketdiscount5for9001',
            'oxaddsum'     => 1,
            'oxaddsumtype' => 'abs',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9001 ),
        ),
        3 => array (
            'oxid'         => 'basketdiscount5for9002',
            'oxaddsum'     => 6,
            'oxaddsumtype' => '%',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9002 ),
        ),
        4 => array (
            'oxid'         => 'absolutebasketdiscount',
            'oxaddsum'     => 5,
            'oxaddsumtype' => 'abs',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
        ),
    ),
    'costs' => array(
        'wrapping' => array(
            0 => array(
                'oxtype' => 'WRAP',
                'oxname' => 'testWrap9001',
                'oxprice' => 9,
                'oxactive' => 1,
                'oxarticles' => array( 9001 )
            ),
            1 => array(
                'oxtype' => 'WRAP',
                'oxname' => 'testWrap9002',
                'oxprice' => 6,
                'oxactive' => 1,
                'oxarticles' => array( 9002 )
            ),
        ),
        'delivery' => array(
            0 => array(
                'oxtitle' => '6_abs_del',
                'oxactive' => 1,
                'oxaddsum' => 6,
                'oxaddsumtype' => 'abs',
                'oxdeltype' => 'p',
                'oxfinalize' => 1,
                'oxparamend' => 99999
            ),
        ),
        'payment' => array(
            0 => array(
                'oxtitle' => '1 abs payment',
                'oxaddsum' => 1,
                'oxaddsumtype' => 'abs',
                'oxfromamount' => 0,
                'oxtoamount' => 1000000,
                'oxchecked' => 1,
                'oxarticles' => array( 9001, 9002 ),
            ),
        ),
        'voucherserie' => array (
            0 => array (
                'oxserienr' => 'abs_4_voucher_serie',
                'oxdiscount' => 6.00,
                'oxdiscounttype' => 'absolute',
                'oxallowsameseries' => 1,
                'oxallowotherseries' => 1,
                'oxallowuseanother' => 1,
                'oxshopincl' => 1,
                'voucher_count' => 1
            ),
        ),
    ),
    'expected' => array (
        'articles' => array (
             9001 => array ( '64,60', '2.131,80' ),// 62,00, 2.046,00
             9002 => array ( '42,64', '682,24' ),// 40,08 641,28
        ),
        'totals' => array (
            'totalBrutto' => '2.814,04',// 2.687,28
            'totalNetto'  => '2.364,74',//2.251,93
            'vats' => array (
                19 => '427,87'
            ),
            'discounts' => array (
                'absolutebasketdiscount' => '3,40',
            ),
            'wrapping' => array(
                'brutto' => '267,24',
                'netto' => '224,57',
                'vat' => '42,67'
            ),
            'delivery' => array(
                'brutto' => '4,08',
                'netto' => '3,43',
                'vat' => '0,65'
            ),
            'payment' => array(
                'brutto' => '0,68',
                'netto' => '0,57',
                'vat' => '0,11'
            ),
            'voucher' => array (
                'brutto' => '4,08',
            ),
            'grandTotal'  => '3016,52'
        ),
    ),
    'options' => array (
        'config' => array(
                'blEnterNetPrice' => false,
                'blShowNetPrice' => false,
                'blShowVATForWrapping' => true,
                'blShowVATForPayCharge' => true,
                'blShowVATForDelivery' => true,
        ),
        'activeCurrencyRate' => 0.68,
    ),
);