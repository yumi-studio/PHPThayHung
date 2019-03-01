<?php
    ob_start();
    require "header.php";
    $buffer=ob_get_contents();
    ob_end_clean();
    $title="Đăng ký dự án";
    $buffer = preg_replace('/(<title>)(.*?)(<\/title>)/i', '$1' . $title . '$3', $buffer);
    echo $buffer;
    require "navigator.php";
    ?>
    <!-- Main -->
        <div id="main" class="container-fluid bg-secondary">
            <div class="row">
                <div class="col-sm-3" id="profile-nav">
                    <?php include "navigator2.php"?>
                </div>
                <div class="col-sm-9">
                    <div id="content">
                    
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addProjectForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Biểu mẫu thêm mới dự án</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Tên dự án</label>
                            <input type="text" name="txtname" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Địa điểm</label>
                            <input type="text" name="txtloc" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Mô tả dự án</label>
                            <textarea name="txtdesc" id="" rows="10" class="form-control col-sm-7"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class="">Thời gian bắt đầu</label>
                                <input type="date" name="start" id="" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="">Thời gian kết thúc</label>
                                <input type="date" name="end" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="button" value="Thêm" class="btn btn-success" name="btnadd" onclick="addProject()" data-toggle="modal" data-target="#addModal" >
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="updateProjectForm" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Biểu mẫu sửa đổi dự án</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Tên dự án</label>
                            <input type="text" name="txtname" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Địa điểm</label>
                            <input type="text" name="txtloc" id="" class="form-control col-sm-7">
                        </div>
                        <div class="form-group row">
                            <label for="" class="col-sm-4">Mô tả dự án</label>
                            <textarea name="txtdesc" id="" rows="10" class="form-control col-sm-7"></textarea>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6">
                                <label for="" class="">Thời gian bắt đầu</label>
                                <input type="date" name="start" id="" class="form-control">
                            </div>
                            <div class="col-sm-6">
                                <label for="" class="">Thời gian kết thúc</label>
                                <input type="date" name="end" id="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <input type="button" value="Lưu" class="btn btn-success" name="btnupdate" data-toggle="modal" data-target="#updateModal" >
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="memberList" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Danh sách thành viên tham gia</h5>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>

        
        <script>
            $(document).ready(()=>{
                loadProject()
            })

            // Thêm project
            function addProject(){
                $.ajax({
                    url: "control/projectProcess.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        pname: $('#addProjectForm [name=txtname]').val(),
                        ploc: $('#addProjectForm [name=txtloc]').val(),
                        pdesc: $('#addProjectForm [name=txtdesc]').val(),
                        pstart: $('#addProjectForm [name=start]').val(),
                        pend: $('#addProjectForm [name=end]').val(),
                        mode: 1
                    },
                    success: function(result){
                        console.log(result);
                        loadProject();
                    }
                })
            }

            // Cập nhật thông tin project
            function updateProject(x){
                $.ajax({
                    url: "control/projectProcess.php",
                    type: "post",
                    dataType: "text",
                    data:{
                        pid: x,
                        pname: $('#updateProjectForm [name=txtname]').val(),
                        ploc: $('#updateProjectForm [name=txtloc]').val(),
                        pdesc: $('#updateProjectForm [name=txtdesc]').val(),
                        pstart: $('#updateProjectForm [name=start]').val(),
                        pend: $('#updateProjectForm [name=end]').val(),
                        mode: 2
                    },
                    success: function(result){
                        console.log(result);
                        loadProject();
                    }
                })
            }

            // Nạp danh sách project
            function loadProject(){
                $.ajax({
                    url: "control/load-project.php",
                    type: "post",
                    dataType: "text",
                    data:{},
                    success: function(result){
                        $('#content').html(result);
                        sorting();
                    }
                })
            }

            // Xóa project
            function deleteProject(x){
                $.ajax({
                    url: "control/del-project.php",
                    type: "post",
                    dataType: "text",
                    data: {
                        id: x
                    },
                    success: function(result){
                        console.log(result);
                        sorting();
                    }
                })
            }

            // Lấy dữ liệu project
            function takeProjectData(x){
                $.ajax({
                    url: "control/projectdata.php",
                    type:"post",
                    dataType: "json",
                    data: {
                        id: x
                    },
                    success: function(result){
                        console.log(result);
                        $('#updateProjectForm [name=txtname]').val(result.name);
                        $('#updateProjectForm [name=txtloc]').val(result.location);
                        $('#updateProjectForm [name=txtdesc]').val(result.description);
                        $('#updateProjectForm [name=btnupdate]').on("click",function(){
                            updateProject(result.id)
                        })
                    }
                })
            }

            // Hiển thị danh sách thành viên của dự án
            function showMember(x){
                $.ajax({
                    url: "control/memberlist.php",
                    type: "post",
                    datatype: "text",
                    data: {id: x},
                    success: function(result){
                        console.log(result);
                        $('#memberList .modal-body').html(result);
                    }
                })
            }

            // Sắp xếp project
            function sorting(){
                var mode=$('[name=sortmode]').val();
                var reg = $('[name="reg[]"]:checked').val();
                if(reg==undefined || mode==-1){
                    return;
                }
                
                if(mode!=-1){
                    $.ajax({
                        url: "control/projectsort.php",
                        type: "get",
                        datatype: "text",
                        data: {
                            mode: mode,
                            reg: reg
                        },
                        success: function(result){
                            $('#content .card-body').remove();
                            $("#content .card").append(result);
                        }
                    })
                }
            }
        </script>
    <?php
    require "footer.php";
?>