<?php
/* 
 * Itm discount for products (special case according Mantis#320)
 */
$aData = array(
    // Articles
    'articles' => array (
        0 => array (
            // oxarticles db fields
            'oxid'                     => 1000,
            'oxprice'                  => 50.00,
            'oxvat' => 5,
            // Amount in basket
            'amount'                   => 5,
        ),
    ),
    // Discounts
    'discounts' => array (
        // oxdiscount DB fields
        0 => array (
            'oxid'         => 'testitmdiscount',
            'oxshopid' => 1,
            'oxshopincl' => 1,
            'oxshopexcl' => 0,
            'oxaddsum'     => 0,
            'oxaddsumtype' => 'itm',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxprice' => 0,
            'oxpriceto' => 0,
            'oxactive' => 1,
            'oxitmartid' => 1003,
            'oxitmamount' => 1,
            'oxitmmultiple' => 0
        ),
        1 => array (
            // ID needed for expectation later on, specify meaningful name
            'oxid'         => 'testdiscountfrom200',
            'oxshopid' => 1,
            'oxshopincl' => 1,
            'oxaddsum'     => 10,
            'oxaddsumtype' => '%',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxprice' => 0,
            'oxpriceto'=> 999999,
            'oxactive' => 1
        ),
    ),
    // TEST EXPECTATIONS
    'expected' => array (
        // Article expected prices: ARTICLE ID => ( Unit price, Total Price )
        'articles' => array (
             1000 => array ( '50,00', '250,00' ),
        ),
        // Expectations of other totals
        'totals' => array (
            // Total BRUTTO
            'totalBrutto' => '250,00',
            // Total NETTO
            'totalNetto'  => '214,29',
            // Total VAT amount: vat% => total cost
            'vats' => array (
                5 => '10,71'
            ),
            // Total discount amounts: discount id => total cost
            'discounts' => array (
                // Expectation for special discount with specified ID
                'testdiscountfrom200' => '25,00',
                //'testitmdiscount' => '0,00'
            ),
           
            // GRAND TOTAL
            'grandTotal'  => '225,00'
        ),
    ),
    'options' => array (
            // Configs (real named)
            'config' => array(
                    'blEnterNetPrice' => false,
                    'blShowNetPrice' => false,
            ),
            // Other options
            'activeCurrencyRate' => 1,
    ),
);