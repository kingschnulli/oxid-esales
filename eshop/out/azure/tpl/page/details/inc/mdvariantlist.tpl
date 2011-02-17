      [{ assign var='oFirstVariant' value=null}]
      
      [{foreach from=$oVariantList item=variant_product}]
        [{if !$oFirstVariant }]
          [{assign var='oFirstVariant' value=$variant_product}]
          [{assign var='sVariantId' value=$oFirstVariant->getId()|regex_replace:"/\W/":""}]
        [{/if}]
      [{/foreach }]

      <select class="variantSelect" name="variant[[{$variant_product->getId()}]]">
        [{foreach from=$oVariantList name=variants item=variant_product}]
          <option value="[{$variant_product->getArticleId()}]">
          [{$variant_product->getName()}]
          </option>
        [{/foreach}]
      </select>

  [{ if $variant_product->getFirstMdSubvariant()}]
    [{include file="page/details/inc/mdvariantlist.tpl" oVariantList=$variant_product->getMdSubvariants()}]
  [{/if }]
