<?php
/* 
 * Checking when prices are entered in NETTO
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
    // Additional costs
    'costs' => array(
        // Wrappings
        'wrapping' => array(
            // oxwrapping DB fields
            0 => array(
                'oxtype' => 'WRAP',
                'oxname' => 'testWrap1000',
                'oxprice' => 0.9,
                'oxactive' => 1,
                'oxarticles' => array ()
            ),
            1 => array(
                'oxtype' => 'CARD',
                'oxname' => 'testCard1000',
                'oxprice' => 0.2,
                'oxactive' => 1,
                'oxarticles' => array ()
            )
        )
    ),
    // TEST EXPECTATIONS
    'expected' => array (
        // Article expected prices: ARTICLE ID => ( Unit price, Total Price )
        'articles' => array (
             1000 => array ( '50,00', '150,00' )
        ),
        // Expectations of other totals
        'totals' => array (
            // Total BRUTTO
            'totalBrutto' => '157,50',
            // Total NETTO
            'totalNetto'  => '150,00',
            // Total VAT amount: vat% => total cost
            'vats' => array (
                5 => '7,50'
            ),
            // Total wrapping amounts
            'wrapping' => array( 
                'brutto' => '3,05'
            ),
            // GRAND TOTAL
            'grandTotal'  => '157,71'
        )
    ),
    // Test case options
    'options' => array (
        // Configs (real named)   
        'config' => array(
            'blDeliveryVatOnTop' => true,
            'blWrappingVatOnTop' => true,
            'blEnterNetPrice' => true,
        )
    )
);