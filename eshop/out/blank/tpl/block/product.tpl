<div class="product hproduct box [{$size}]">
  <div class="title fn">[{ $product->oxarticles__oxtitle->value }]</div>
  <div class="cost price">[{ $product->getFPrice() }] [{ $currency->sign}]</div>
  <img class="image photo" src="[{$product->getPictureUrl(1)}]" alt="[{ $product->oxarticles__oxtitle->value }]">
</div>