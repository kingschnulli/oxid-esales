<?php $shopUrl = $_GET['shopUrl']?>
<!DOCTYPE html>
<html>
<head>
    <title>OXID eShop javascript tests</title>
    <link rel="stylesheet" href="qunit/qunit.css" type="text/css" media="screen">
    <script type="text/javascript" src="qunit/qunit.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/jquery.min.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/jquery-ui.min.js"></script>

    <!-- Your project file goes here -->
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/jquery.ui.oxid.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxrating.js"></script>
    <script type="text/javascript" src="http://<?php echo $shopUrl ?>/out/azure/src/js/widgets/oxcompare.js"></script>

    <!-- Your tests file goes here -->
    <script type="text/javascript" src="inputvalidatorTests.js"></script>
    <script type="text/javascript" src="countrystateselectTests.js"></script>
    <script type="text/javascript" src="comparelistTests.js"></script>
    <script type="text/javascript" src="sliderTests.js"></script>
    <script type="text/javascript" src="ratingTests.js"></script>
    <script type="text/javascript" src="variantTests.js"></script>
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