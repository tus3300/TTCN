<!-- BEGIN: main -->
<h2>{LANG.product_list}</h2>
<div class="product-list">
    <!-- BEGIN: product -->
    <div class="product">
        <img src="{PRODUCT.ImageURL}" alt="{PRODUCT.ProductName}">
        <h3>{PRODUCT.ProductName}</h3>
        <p>{PRODUCT.Price} VNĐ</p>
        <a href="{NV_BASE_SITEURL}index.php?{NV_LANG_VARIABLE}={NV_LANG_DATA}&{NV_NAME_VARIABLE}={MODULE_NAME}&{NV_OP_VARIABLE}=product_detail&id={PRODUCT.ProductID}">{LANG.product_detail}</a>
    </div>
    <!-- END: product -->
</div>
<!-- END: main -->