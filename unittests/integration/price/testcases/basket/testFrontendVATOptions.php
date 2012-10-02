<?php
/* 
 * Checking VAT displaying
 */
$aData = array(
    // Articles
    'articles' => array (
        0 => array (
            // oxarticles db fields
            'oxid'                     => 1000,
            'oxprice'                  => '50,00',
            'oxvat'                    => 5,
            // Amount in basket
            'amount'                   => 3,
        )
    ),
    // Discounts
    'discounts' => array (
        // oxdiscount DB fields
        0 => array (
            // ID needed for expectation later on, specify meaningful name
            'oxid'         => 'categoryDiscount',
            'oxaddsum'     => 10,
            'oxaddsumtype' => '%',
            'oxamount' => 1,
            'oxamountto' => 99999,
            'oxactive' => 1,
            // If for article, specify here
            'oxarticles' => array ( 1000 ),
        )
    ),
    // Additional costs
    'costs' => array(
        // Wrappings
        'wrapping' => array(
            // oxwrapping DB fields
            0 => array(
                'oxtype' => 'WRAP',
                'oxname' => 'testWrap1000',
                'oxprice' => '0,90',
                'oxactive' => 1,
                // If for article, specify here
                'oxarticles' => array()
            )
        ),
        // Delivery
        'delivery' => array(
            0 => array(
                // oxdelivery DB fields
                'oxactive' => 1,
                'oxaddsum' => 0,
                'oxaddsumtype' => 'abs',
                'oxdeltype' => 'p',
                'oxfinalize' => 1,
                'oxparamend' => 99999,
                '...' => ''
            ),
        ),
    ),
    // TEST EXPECTATIONS
    'expected' => array (
        // Article expected prices: ARTICLE ID => ( Unit price, Total Price )
        'articles' => array (
             1000 => array ( '45,00', '135,00' )
        ),
        // Expectations of other totals
        'totals' => array (
            // Total BRUTTO
            'totalBrutto' => '141,75',
            // Total NETTO
            'totalNetto'  => '135,00',
            // Total VAT amount: vat% => total cost
            'vats' => array (
                5 => '6,75'
            ),
            // Total discount amounts: discount id => total cost
            'discounts' => array (
                // Expectation for special discount with specified ID
                //'categoryDiscount' => '15,00',
            ),
            // Total wrapping amounts
            'wrapping' => array( 
                'brutto' => '2,70',
                'netto' => '2,57',
                'vat' => '0,13'
            ),
            // Total delivery amounts
            'delivery' => array(
                'brutto' => 0.00,
                'netto' => '0,00',
                'vat' => '0,00'
            ),
            // GRAND TOTAL
            'grandTotal'  => '141,75'
        ),
    ),
    // Test case options
    'options' => array (
        // Configs (real named)   
        'config' => array(
            'blShowVATForDelivery' => true,
            'blShowVATForPayCharge' => true,
            'blShowVATForWrapping' => true
        ),
        // Other options
        'activeCurrencyRate' => 1,
    ),
);