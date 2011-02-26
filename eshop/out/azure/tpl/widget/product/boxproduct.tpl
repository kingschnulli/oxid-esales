[{ assign var="_sTitle" value="`$_oBoxProduct->oxarticles__oxtitle->value` `$_oBoxProduct->oxarticles__oxvarselect->value`"|strip_tags }]
[{assign var="currency" value=$oView->getActCurrency()}]
<li>
    <a href="[{$_oBoxProduct->getMainLink()}]">[{ $_sTitle }]<br>
    [{oxhasrights ident="SHOWARTICLEPRICE"}]
    [{if $_oBoxProduct->getFPrice()}]
        <strong>[{ $_oBoxProduct->getFPrice() }] [{ $currency->sign}]</strong>
    [{/if}]
    [{/oxhasrights}]
    </a>
</li>