<?php
    ob_start();
    require "header.php";
    $buffer=ob_get_contents();
    ob_end_clean();
    $title="Lương/Thu nhập";
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
                <div class="col-sm-9" id="content">
                    <div class="card" id="<?php echo($_SESSION['status']!=0?"mysalary":"salarylist")?>">
                        <div class="card-header">
                            <button id="btnsave" class="btn btn-dark" disabled>Lưu thay đổi</button>
                            <button class="btn btn-light float-right" disabled>CT Tính lương = Cơ bản + (điểm thưởng)*1000 - (điểm trừ)*500</button>
                        </div>
                        
                        <div class="card-body">
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        var mode;
        $(document).ready(()=>{
            mode = $('.card').prop('id');
            $.ajax({
                url: "control/salarydata.php",
                type: "post",
                dataType: "text",
                data: {
                    mode: mode
                },
                success: function(result){
                    $('.card-body').html(result);
                }
            })
            $('#btnsave').click(function(){
                var list = $('tbody tr').toArray();
                list.forEach(pt => {
                    $.ajax({
                        url: "control/updatesalary.php",
                        type: "post",
                        datatype: "text",
                        data: {
                            id: $(pt).prop('id'),
                            bonus: $(pt).find('[name=bonus]').val(),
                            fines: $(pt).find('[name=fines]').val()
                        },
                        success: function(result){
                            console.log(result)
                        }
                    })
                });
                $('#btnsave').prop('disabled',true)
                alert("Đã cập nhật!")
            })
        })

        function increase(x){
            var input = $(x).parent().siblings()[1];
            $(input).val(function(){
                return parseInt($(this).val())+1
            })
            updateSalary($(x).parents()[3]);
        }
        function decrease(x){
            var input = $(x).parent().siblings()[0];
            $(input).val(function(){
                return parseInt($(this).val())-1
            })
            updateSalary($(x).parents()[3]);
        }
        function updateSalary(x){
            var fixed = $(x).children('#fs').html();
            var bonus = $(x).find('input[name=bonus]').val();
            var fines = $(x).find('input[name=fines]').val();

            // CT tính lương
            var total = parseInt(fixed)+parseInt(bonus)*1000-parseInt(fines)*500;
            $(x).children(':last-child').html(total);
            $('#btnsave').prop("disabled",false)
        }
        
        </script>
    <?php
    require "footer.php";
?>