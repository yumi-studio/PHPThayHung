<?php
    // echo $_SESSION['branch_id'];
    ob_start();
    require "header.php";
    $buffer=ob_get_contents();
    ob_end_clean();
    $title="Quản lý nhân viên";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
    if($_SESSION['status']!=0 && $_SESSION['status']!=1){
        header('location: profile.php');
    }
    require "navigator.php";
    ?>
    <!-- Main -->
        <div id="main" class="container-fluid bg-secondary">
            <div class="row">
                <div class="col-sm-3" id="profile-nav">
                    <?php include "navigator2.php"?>
                </div>
                <div class="col-sm-9" id="content">
                    <div class="card">
                        <div class="card-header">
                            <form class="inline-form float-left" onsubmit="return false">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Tìm kiếm</div>
                                </div>
                                <div class="dropdown">
                                    <input type="text" name="txtsearch" id="searchbox" class="form-control" onkeyup="search(this)" autocomplete="off">
                                    <div class="dropdown-menu">
                                    </div>
                                </div>
                                
                            </div>
                            </form>
                            <button type="button" data-toggle="modal" data-target="#addModal" class="btn btn-dark float-right">Thêm nhân viên</button>
                        </div>
                        <div class="card-body">
                            <table class="table bordered table-striped">
                                <thead class="">
                                    <tr>
                                        <th class="w-25">Họ và tên</th>
                                        <th class="w-25">Chi nhánh</th>
                                        <th class="w-25">Vị trí</th>
                                        <th class="w-25"></th>
                                    </tr>
                                </thead>
                                <tbody id="accountList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>


        <!-- ADD FORM -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">Thêm nhân viên mới</div>
                <form>
                    <div class="modal-body">
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Tên đăng nhập</label>
                                <input type="text" name="txtuser" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Mật khẩu</label>
                                <input type="text" name="txtpass" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Họ và tên</label>
                                <input type="text" name="txtname" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Địa chỉ</label>
                                <input type="text" name="txtaddr" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Email</label>
                                <input type="text" name="txtemail" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Số điện thoại</label>
                                <input type="text" name="txtphone" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Chi nhánh</label>
                            <select name="txtbranch" id="" class="form-control col-sm-7" <?php if($_SESSION['status']!=0) echo("disabled")?>>
                                <?php
                                switch($_SESSION['branch_id']){
                                    case "1":
                                        echo '<option value="1">Miền Bắc</option>';
                                        break;
                                    case "2":
                                        echo '<option value="2">Miền Trung</option>';
                                        break;
                                    case "3":
                                        echo '<option value="3">Miền Nam</option>';
                                        break;
                                    default:
                                        ?>
                                        <option value="1">Miền Bắc</option>
                                        <option value="2">Miền Trung</option>
                                        <option value="3">Miền Nam</option>
                                        <?php
                                }
                                ?>
                                
                                
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Chức vụ</label>
                            <select name="txtrole" id="" class="form-control col-sm-7">
                            <?php if($_SESSION['status']==1) echo '<option value="1">Giám đốc</option>';?>
                                <option value="3">Trưởng phòng</option>
                                <option value="4">Nhân viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="button" value="Thêm" class="btn btn-success" name="btnadd" onclick="addAccount()" data-toggle="modal" data-target="#addModal" >
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!-- UPDATE FORM -->
        <div class="modal fade" tabindex="-1" role="dialog" id="updateModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form>
                    <div class="modal-header">Sửa thông tin</div>
                    <div class="modal-body">
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Tên đăng nhập</label>
                                <input type="text" name="txtuser" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Mật khẩu</label>
                                <input type="text" name="txtpass" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Họ và tên</label>
                                <input type="text" name="txtname" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Địa chỉ</label>
                                <input type="text" name="txtaddr" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Email</label>
                                <input type="text" name="txtemail" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                                <label for="" class="col-sm-4">Số điện thoại</label>
                                <input type="text" name="txtphone" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Chi nhánh</label>
                            <select name="txtbranch" id="" class="form-control col-sm-7" <?php if($_SESSION['status']!=0) echo("disabled")?>>
                                <option value="1">Miền Bắc</option>
                                <option value="2">Miền Trung</option>
                                <option value="3">Miền Nam</option>
                            </select>
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Chức vụ</label>
                            <select name="txtrole" id="" class="form-control col-sm-7">
                                <?php if($_SESSION['status']==1) echo '<option value="1">Giám đốc</option>';?>
                                <option value="3">Trưởng phòng</option>
                                <option value="4">Nhân viên</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="button" value="Lưu" class="btn btn-success" name="btnupdate" data-toggle="modal" data-target="#updateModal">
                    </div>
                </form>
                </div>
            </div>
        </div>

        <!--  -->
        <script>
            // Tải lại danh sách nhân viên
            function loadEmployee() {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        $('#accountList').html(this.responseText);
                    }
                }
                xhttp.open("GET","control/load-employee.php",true);
                xhttp.send();
            }

            // Lấy dữ liệu từ database điền vào form
            function setEdit(x){
                $.ajax({
                    url: "control/accountdata.php",
                    type: "post",
                    dataType: "json",
                    data: {
                        id: x
                    },
                    success: function(result){
                        console.log(result);
                        $('#updateModal [name=txtuser]').val(result.userName);
                        $('#updateModal [name=txtpass]').val(result.password);
                        $('#updateModal [name=txtname]').val(result.name);
                        $('#updateModal [name=txtaddr]').val(result.address);
                        $('#updateModal [name=txtemail]').val(result.email);
                        $('#updateModal [name=txtphone]').val(result.phone);
                        $('#updateModal [name=txtbranch]').val(result.department);
                        $('#updateModal [name=txtrole]').val(result.status);
                        $('#updateModal [name=btnupdate]').on("click",function(){
                            updateAccount(result.id);
                        })
                    }
                })
                // $("[name='txtname']").val(xhttp.responseText);
            }

            // Xóa tài khoản
            function deleteAccount(x){
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function(){
                    if (this.readyState == 4 && this.status == 200) {
                        loadEmployee();
                    }
                }
                xhttp.open("GET","control/del-employee.php?id="+x,true);
                xhttp.send();
            }

            // Thêm tài khoản vào database
            function addAccount(){
                $.ajax({
                    url:"control/add-employee.php",
                    type:"post",
                    dataType:"text",
                    data:{
                        txtuser:    $('#addModal [name=txtuser]').val(),
                        txtpass:    $('#addModal [name=txtpass]').val(),
                        txtname:    $('#addModal [name=txtname]').val(),
                        txtaddr:    $('#addModal [name=txtaddr]').val(),
                        txtemail:   $('#addModal [name=txtemail]').val(),
                        txtphone:   $('#addModal [name=txtphone]').val(),
                        txtbranch:    $('#addModal [name=txtbranch]').val(),
                        txtrole:    $('#addModal [name=txtrole]').val(),
                        btnadd:     "1"
                    },
                    success: function(data){
                        console.log(data);
                        
                        loadEmployee();
                    }
                })
            }
            function updateAccount(x){
                $.ajax({
                    url:"control/add-employee.php",
                    type:"post",
                    dataType:"text",
                    data:{
                        id:         x,
                        txtuser:    $('#updateModal [name=txtuser]').val(),
                        txtpass:    $('#updateModal [name=txtpass]').val(),
                        txtname:    $('#updateModal [name=txtname]').val(),
                        txtaddr:    $('#updateModal [name=txtaddr]').val(),
                        txtemail:   $('#updateModal [name=txtemail]').val(),
                        txtphone:   $('#updateModal [name=txtphone]').val(),
                        txtbranch:   $('#updateModal [name=txtbranch]').val(),
                        txtrole:   $('#updateModal [name=txtrole]').val(),
                        btnupdate:  "1"
                    },
                    success: function(data,statusCode){
                        console.log(data);
                        loadEmployee();
                    }
                })
            }

            function search(x){
                var q = $(x).val();
                $.ajax({
                    url: "control/search.php",
                    type: "get",
                    datatype: "text",
                    data:{
                        q: q
                    },
                    success: function(result){
                        if(result!=""){
                            $('.dropdown-menu').addClass('d-block').html(result);
                        }else{
                            $('.dropdown-menu').removeClass('d-block')
                        }
                    }
                })
            }

            $(document).ready(()=>{
                loadEmployee();
                $('#searchbox').focusout(function(){
                    $('body').click(function(){
                        $('.dropdown-menu').removeClass('d-block')
                    })
                })
            })
        </script>
    <?php
    require "footer.php";
?>