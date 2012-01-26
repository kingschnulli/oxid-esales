[{assign var=aPaymentMethods value=$oView->getRDFaPaymentMethods()}]
[{foreach from=$aPaymentMethods item=oPaymentMethod}]
    [{if $oPaymentMethod->oxpayment__oxobjectid->value}]
        <div rel="gr:acceptedPaymentMethods" resource="http://purl.org/goodrelations/v1#[{$oPaymentMethod->oxpayment__oxobjectid->value}]"></div>
    [{else}]
        [{assign var=sContentName value=$oViewConf->getViewConfigParam("sRDFaPaymentChargeSpecLoc")}]
        [{oxifcontent ident=$sContentName object="oCont"}]
        <div rel="gr:acceptedPaymentMethods" resource="[{$oCont->getLink()}]#[{$oPaymentMethod->oxpayment__oxdesc->value|strip:''|cat:'_'|cat:$oPaymentMethod->oxpayment__oxid->value}]"></div>
        [{/oxifcontent}]
    [{/if}]
[{/foreach}]