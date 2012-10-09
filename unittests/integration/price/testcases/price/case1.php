<?php
/* 
 * Price enter mode: brutto
 * Price view mode: brutto 
 * Discounts: 2
 *  1. shop; abs
 *  2. shop; %
 * 
 */
$aData = array (
        'articles' => array (
                0 => array (
                        'oxid'                     => '1001_a',
                        'oxprice'                  => 100.55,
                        'oxvat'                    => 20,
                ),
                1 => array (
                        'oxid'                     => '1001_b',
                        'oxprice'                  => 100.55,
                        'oxvat'                    => 20,
                ),
        ),
        'discounts' => array (
                0 => array (
                        'oxid'         => 'abs',
                        'oxaddsum'     => 20,
                        'oxaddsumtype' => 'abs',
                        'oxprice'    => 0,
                        'oxpriceto' => 99999,
                        'oxamount' => 0,
                        'oxamountto' => 99999,
                        'oxactive' => 1,
                        'oxarticles' => array ( '1001_a' ),
                ),
                1 => array (
                        'oxid'         => 'percent',
                        'oxaddsum'     => 20,
                        'oxaddsumtype' => '%',
                        'oxprice'    => 0,
                        'oxpriceto' => 99999,
                        'oxamount' => 0,
                        'oxamountto' => 99999,
                        'oxactive' => 1,
                        'oxarticles' => array ( '1001_b' ),
                ),
        ),
        'expected' => array (
                '1001_a' => array (
                        'brutto' => 80.55,
                        /*'netto' => 67.12,
                        'vat' => 20,
                        'vatValue' => 13.43,
                        'discounts' => null,*/
                ),
                '1001_b' => array (
                        'brutto' => 80.44,
                        /*'netto' => 67.12,
                        'vat' => 20,
                        'vatValue' => 13.33,
                        'discounts' => null,*/
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