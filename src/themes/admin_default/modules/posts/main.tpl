<!-- BEGIN: main -->
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="{CREATE_URL}" class="btn btn-success">{LANG.create_product}</a>
        <form method="get" action="">
            <label for="category_filter" class="me-2">Chọn danh mục:</label>
            <select class="form-select d-inline-block w-auto" id="category_filter" name="category_filter" onchange="this.form.submit()">
                <option value="">Tất cả danh mục</option>
                <!-- BEGIN: category_option -->
                <option value="{CATEGORY.id}" {if $category_filter == CATEGORY.id}selected{/if}>{CATEGORY.name}</option>
                <!-- END: category_option -->
            </select>
        </form>
    </div>

    <div class="row">
        <!-- BEGIN: loop -->
        <div class="col-md-4 mb-4">
            <div class="product-card">
                <img src="{NV_BASE_SITEURL}{ROW.imageurl}" class="product-image" alt="{ROW.productname}">
                <div class="product-info">
                    <h5 class="product-title">{ROW.productname}</h5>
                    <p class="product-description">{ROW.description}</p>
                    <p><strong>Danh mục:</strong> {ROW.category_name}</p>
                    <p><strong>Giá:</strong> {ROW.price} VNĐ</p>
                    <p><strong>Số lượng:</strong> {ROW.quantity}</p>
                    <p><strong>Trạng thái:</strong> {ROW.status}</p>
                    <p><strong>Chi tiết:</strong> {ROW.detaileddescription}</p>
                    <div class="product-actions">
                        <a href="{ROW.edit_url}" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="{ROW.delete_url}" class="btn btn-danger btn-sm">Xóa</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: loop -->
    </div>
</div>
<!-- END: main -->

<!-- BEGIN: CSS -->
<style>
/* Cấu hình chung cho container */
.container {
    margin-top: 30px;
    padding: 0 15px;
}

/* Định dạng cho các sản phẩm */
.product-card {
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Hình ảnh sản phẩm */
.product-image {
    width: 100%;
    height: 200px; /* Đặt chiều cao cố định cho ảnh */
    object-fit: cover; /* Đảm bảo ảnh không bị biến dạng và cắt xén nếu cần */
    object-position: center; /* Giữ ảnh ở trung tâm */
}

/* Thông tin sản phẩm */
.product-info {
    padding: 15px;
}

.product-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 10px;
    color: #333;
}

.product-description {
    font-size: 1rem;
    color: #555;
    margin-bottom: 10px;
}

/* Định dạng cho thông tin chi tiết (Giá, Số lượng, Danh mục, Trạng thái) */
.product-info p {
    font-size: 0.95rem;
    color: #666;
    margin-bottom: 8px;
}

/* Định dạng cho các nút */
.product-actions {
    margin-top: 15px;
    display: flex;
    justify-content: space-between;
}

.btn {
    padding: 5px 10px;
    font-size: 0.875rem;
    border-radius: 5px;
    text-decoration: none;
}

.btn-warning {
    background-color: #f0ad4e;
    color: white;
}

.btn-warning:hover {
    background-color: #ec971f;
}

.btn-danger {
    background-color: #d9534f;
    color: white;
}

.btn-danger:hover {
    background-color: #c9302c;
}

@media (max-width: 768px) {
    .col-md-4 {
        /* Khi màn hình nhỏ hơn 768px, hiển thị mỗi sản phẩm một hàng */
        flex: 0 0 100%;
        max-width: 100%;
    }
}
</style>
<!-- END: CSS -->
