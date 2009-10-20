    
    <script language=JavaScript> <!--
    function showVariant(i)
    {
        if (i == 0)
            document.getElementById('variant_box').innerHTML = '';
        if (i == 1)
            document.getElementById('variant_box').innerHTML = document.getElementById('variant_8a142c4100e0b2f57.59530204').innerHTML;
        if (i == 2)
            document.getElementById('variant_box').innerHTML = document.getElementById('variant_8a142c410f55ed579.98106125').innerHTML;
        if (i == 3)
            document.getElementById('variant_box').innerHTML = document.getElementById('variant_8a142c4113f3b7aa3.13470399').innerHTML;    
        
    }
    //-->
    </script>
    <div class="variant_selector">
    <select name=variantSelector onChange="showVariant(this.value)">
      <option value="0">Parent
      <option value="1">Variant 1
      <option value="2">Variant 2
      <option value="3">Variant 3
    </select>
    </div>
    
    <div id="variant_box" class="product  thinest inlist"></div>