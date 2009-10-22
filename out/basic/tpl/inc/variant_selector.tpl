    
    [{oxvariantselect value=$product->getMdVariants() separator=" " artid=$product->getId()}]
    
    [{oxscript add="oxid.mdVariants.mdAttachAll();"}]
    [{oxscript add="oxid.mdVariants.showMdRealVariant();"}]
    
    <div id="md_variant_box" class="product  thinest inlist"></div>