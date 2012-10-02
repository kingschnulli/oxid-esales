<?php
/*
 * From advBasketCalc.csv: Complex order calculation II order.
 */
$aData = array(
    'articles' => array (
        0 => array (
            'oxid'                     => 9003,
            'oxprice'                  => 100,
            'oxvat'                    => 19,
            'amount'                   => 33,
        ),
        1 => array (
            'oxid'                     => 9004,
            'oxprice'                  => 66,
            'oxvat'                    => 19,
            'amount'                   => 16,
        ),
    ),
    'discounts' => array (
        0 => array (
            'oxid'         => 'shopdiscount5for9003',
            'oxaddsum'     => 5,
            'oxaddsumtype' => 'abs',
            'oxamount' => 0,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9003 ),
        ),
        1 => array (
            'oxid'         => 'shopdiscount5for9004',
            'oxaddsum'     => 5,
            'oxaddsumtype' => '%',
            'oxamount' => 0,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9004 ),
        ),
        2 => array (
            'oxid'         => 'basketdiscount5for9003',
            'oxaddsum'     => 1,
            'oxaddsumtype' => 'abs',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9003 ),
        ),
        3 => array (
            'oxid'         => 'basketdiscount5for9004',
            'oxaddsum'     => 6,
            'oxaddsumtype' => '%',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
            'oxarticles' => array ( 9004 ),
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
                'oxname' => 'testWrap9003',
                'oxprice' => 9,
                'oxactive' => 1,
                'oxarticles' => array( 9003 )
            ),
            1 => array(
                'oxtype' => 'WRAP',
                'oxname' => 'testWrap9003',
                'oxprice' => 6,
                'oxactive' => 1,
                'oxarticles' => array( 9004 )
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
                'oxarticles' => array( 9003, 9004 ),
            ),
        ),
        'voucherserie' => array (
            0 => array (
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
             9003 => array ( '114,00', '3.762,00' ),
             9004 => array ( '74,61', '1.193,76' ),
        ),
        'totals' => array (
            'totalBrutto' => '4.851,08',
            'totalNetto'  => '4.067,30',
            'vats' => array (
                19 => '772,78'
            ),
            'discounts' => array (
                'absolutebasketdiscount' => '5,00',
            ),
            'wrapping' => array(
                'brutto' => '467,67',
                'netto' => '330,25',
                'vat' => '62,75'
            ),
            'delivery' => array(
                'brutto' => '6,00',
                'netto' => '5,04',
                'vat' => '0,96'
            ),
            'payment' => array(
                'brutto' => '1,00',
                'netto' => '0,84',
                    'vat' => '0,16'
            ),
            'voucher' => array (
                'brutto' => '6,00',
            ),
            'grandTotal'  => '5.316,75'
        ),
    ),
    'options' => array (
        'config' => array(
                'blEnterNetPrice' => true,
                'blShowNetPrice' => false,
                'blShowVATForWrapping' => true,
                'blShowVATForPayCharge' => true,
                'blShowVATForDelivery' => true,
        ),
        'activeCurrencyRate' => 1,
    ),
);