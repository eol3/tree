<html>
<title>tree</title>
<meta charset="UTF-8">
<style>

a{
    text-decoration: none
}

</style>
<body>
<?php
    echo "<li><a href='".base_url('tree/add_node/0')."'>根目錄+</a></li>";
    $level = 0;
    $last_node_parent = 0;
    foreach($treearray as $titem)
    {
        
       if($level < $titem['level']){
           echo "<ul>";
           
       }
       if($level > $titem['level']){
           
           echo "</ul>";
           //$level = $titem['level'];
       }
       
       $num = $level - $titem['level'];
       if($num >= 2)
       {
           while($num != 1)
           {
               $num --;
               echo "</ul>";
           }
       }
       
       echo "<li>".$titem['title']."&nbsp;&nbsp;<a href='".base_url('tree/add_node/'.$titem['id'])."'>+</a>
                                    &nbsp;&nbsp;<a href='".base_url('tree/delete_node/'.$titem['id'])."'>-</a></li>";
       $last_node_parent = $titem['parent'];
       
       
       
       $level = $titem['level'];
    }
    
    while($level > 0)
    {
       echo "</ul>";
       $level --;
    }
    
?>

</body>
</html>