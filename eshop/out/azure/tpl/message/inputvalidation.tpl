[{foreach from=$aErrors item=oError }]
  <span class="js-oxError_notEmpty req">[{oxmultilang ident=$oError->getMessage()}]</span>
[{/foreach }]