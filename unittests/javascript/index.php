<?php $shopUrl = $_GET['shopUrl']?>
<!DOCTYPE html>
<html>
<head>
    <title>OXID eShop javascript tests</title>
    <link rel="stylesheet" href="qunit/qunit.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/libs/superfish.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/typography.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/layouts.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/fxstyles.css" type="text/css" media="screen">
    <link rel="stylesheet" href="http://<?php echo $shopUrl ?>/out/azure/src/css/elements.css" type="text/css" media="screen">

    <script type="text/javascript" src="qunit/qunit.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/libs/jquery.min.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/libs/jquery-ui.min.js"></script>

    <!-- Your project file goes here -->
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxrating.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxcompare.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxcountrystateselect.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxslider.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxarticleactionlinksselect.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxinputvalidator.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxdropdown.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxarticlebox.js"></script>

    <!-- Your tests file goes here -->
    <script type="text/javascript" src="inputvalidatorTests.js"></script>
    <script type="text/javascript" src="countrystateselectTests.js"></script>
    <script type="text/javascript" src="comparelistTests.js"></script>
    <script type="text/javascript" src="sliderTests.js"></script>
    <script type="text/javascript" src="ratingTests.js"></script>
    <script type="text/javascript" src="dropdownTests.js"></script>
    <script type="text/javascript" src="articleboxTests.js"></script>    
    <!--<script type="text/javascript" src="variantTests.js"></script>-->
</head>
<body>
    <h1 id="qunit-header">OXID eShop javascript tests</h1>
    <h2 id="qunit-banner"></h2>
    <div id="qunit-testrunner-toolbar"></div>
    <h2 id="qunit-userAgent"></h2>
    <ol id="qunit-tests"></ol>
    <div id="fixture"></div>
</body>
</html>