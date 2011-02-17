[{ assign var="_sTitle" value="`$_oBoxTopProduct->oxarticles__oxtitle->value` `$_oBoxTopProduct->oxarticles__oxvarselect->value`"|strip_tags}]
<a href="[{$_oBoxTopProduct->getMainLink()}]" class="featured" title="[{$_sTitle}]">
    <img src="[{$_oBoxTopProduct->getIconUrl()}]" alt="[{$_sTitle}]">
</a>
