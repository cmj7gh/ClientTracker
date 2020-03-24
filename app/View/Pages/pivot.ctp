

<?php

// die(var_dump($students))
?>

<script type="text/javascript">
    // This example is the most basic usage of pivotUI()

    $(function(){
        var derivers = $.pivotUtilities.derivers;
        var renderers = $.extend($.pivotUtilities.renderers,
            $.pivotUtilities.plotly_renderers);

        $("#output").pivotUI(
            [
                <?php

                    foreach ($students as $student):
                        echo "{school: \"" . $student['School']['name'] 
                            . "\", country: \"" . $student['Student']['country']
                            . "\", graduationyear: \"" . $student['Student']['graduation_year']
                            . "\"},";
                    endforeach;
                ?>
                //{color: "blue", shape: "circle"},
                //{color: "red", shape: "triangle"}
            ],
            {
                rows: ["color"],
                cols: ["shape"],
                renderers: renderers
            }
        );
    });
</script>

<div id="output" style="margin: 30px;"></div>

