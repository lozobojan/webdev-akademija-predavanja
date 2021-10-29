<?php 

    function showAlertDiv($message, $class){
        echo "
            <div class=\"row\">
                <div class=\"col-12 alert $class text-center\">
                    $message
                </div>
            </div>
        ";
    }

?>