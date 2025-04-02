<!-- BEGIN: empty -->
<a href="#" class="btn btn-success">{LANG.create}</a>
<div class="alert alert-info">{LANG.empty}</div>
<!-- END: empty -->

<!-- BEGIN: main -->
<a href="#" class="btn btn-success">{LANG.create}</a>
<div class="table-responsive">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>tên sản phẩm</th>
                <th>tiêu đề</th>
                <th>chi tiết</th>
                <th>Cập nhật gần nhất</th>
                <th>trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <!-- BEGIN: loop -->
            <tr>
                <td>{ROW.productname}</td>
                <td>{ROW.description}</td>
                <td>{ROW.detailedddescription}</td>
                <td>{ROW.updatedat}</td>
                <td>{ROW.status}</td>
                <td>
                    <a href="{ROW.edit_url}" class="btn btn-xs btn-warning">Sửa</a>
                    <a href="{ROW.delete_url}" class="btn btn-xs btn-danger">Xóa</a>
                </td>
            </tr>
            <!-- END: loop -->
        </tbody>
    </table>
</div>
<!-- END: main -->