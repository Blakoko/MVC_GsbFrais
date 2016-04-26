

</div>

</div>
<!--Fin Footer-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php
    if (isset($this->js)) {
        foreach ($this->js as $js) {
            echo '<script  src="' . URL . 'views/' . $js . '"></script>';
        }
    }
?>
</body>

</html>