<!-- BEGIN: main -->
<style>
    .form-container {
        max-width: 500px;
        margin: 20px auto;
        padding: 20px;
        background: #f9f9f9;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
    }

    .form-container label {
        font-weight: bold;
        display: block;
        margin-top: 10px;
    }

    .form-container input,
    .form-container select,
    .form-container textarea {
        width: 100%;
        padding: 8px;
        margin-top: 5px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 16px;
    }

    .form-container textarea {
        height: 80px;
    }

    .form-container button {
        width: 100%;
        padding: 10px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 18px;
        margin-top: 15px;
    }

    .form-container button:hover {
        background: #0056b3;
    }

    /* CSS cho ảnh xem trước */
    .preview-container {
        margin-top: 10px;
        text-align: center;
    }

    .preview-container img {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        display: none; /* Ẩn ban đầu */
    }
</style>

<form method="POST" action="" enctype="multipart/form-data" class="form-container">
    <label for="productname">Tên sản phẩm:</label>
    <input type="text" id="productname" name="productname" required>

    <label for="categoryid">Chọn danh mục:</label>
    <select id="categoryid" name="categoryid" required>
        <!-- BEGIN: category_option -->
        <option value="{CATEGORY.id}">{CATEGORY.name}</option>
        <!-- END: category_option -->
    </select>

    <label for="description">Mô tả sản phẩm:</label>
    <textarea id="description" name="description" required></textarea>

    <label for="detaileddescription">Mô tả chi tiết:</label>
    <textarea id="detaileddescription" name="detaileddescription" required></textarea>

    <label for="imageurl">Hình ảnh sản phẩm:</label>
    <input type="file" id="imageurl" name="imageurl" accept="image/*" required onchange="previewImage(event)">

    <!-- Khu vực hiển thị ảnh xem trước -->
    <div class="preview-container">
        <img id="imagePreview" src="#" alt="Xem trước ảnh">
    </div>

    <label for="quantity">Số lượng:</label>
    <input type="number" id="quantity" name="quantity" required>

    <label for="price">Giá:</label>
    <input type="number" id="price" name="price" required>

    <label for="status">Trạng thái:</label>
    <select id="status" name="status" required>
        <option value="1">Kích hoạt</option>
        <option value="0">Vô hiệu hóa</option>
    </select>

    <button type="submit">Lưu</button>
</form>

<!-- JavaScript để hiển thị ảnh xem trước -->
<script>
    function previewImage(event) {
        var input = event.target;
        var preview = document.getElementById("imagePreview");
        var file = input.files[0];

        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<!-- END: main -->
