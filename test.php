<?php
include "header.php";
include "navigator.php";

?>

<script>

$(document).ready({
    // Ajax
    $.ajax({
        url: "something.php",
        type: "get",
        datatype: "text",
        data: {
            a: "Duy"
        },
        success: function(result){
            console.log(result)
        }

    })
})

</script>


<?php

include "footer.php";
?>