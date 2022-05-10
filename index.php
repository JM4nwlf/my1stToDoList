<?php
require ('config.php');

//initialize errors variable
$errors = ""; 

//insert a quote if submit button is clicked
if(isset($_POST['submit'])) {
    if(empty($_POST['task'])) {
        $errors = "Vous devez indiquer une tâche";
    } else {
        $sql_insert = 'INSERT INTO tasks (task) VALUES ("'.($_POST['task']).'")';
        $res = $mysqli->query($sql_insert); 
      //  header('location: index.php'); 
        //echo $sql_insert;
    }
    
}       

// update date info par lien 
if(isset($_GET['del_task'])){
    //$sql_time="INSERT INTO tasks (delete_time) VALUES (NOW()) where id=".$GET['del_task'];
    $sql_time = 'UPDATE tasks SET delete_time= NOW() WHERE id=' .($_GET['del_task']);
        $res = $mysqli->query($sql_time);
    echo  ($_GET['del_task']);
}

/*
//update date par checkbox
if(isset($_GET['done']) && (isset($_POST['valider'])) ){
    $sql_time = 'UPDATE tasks SET delete_time= NOW() WHERE id=' .($_GET['del_task']);
    $res = $mysqli->query($sql_time);
    echo  ($_GET['done']);  
    echo  ($_GET['valider']);  
    echo $sql_time;     
}
*/
/*
// delete task
if(isset($_GET['del_task'])) {
    $sql_delete = "DELETE FROM tasks WHERE id=".$_GET['del_task'];
    $res = $mysqli->query($sql_delete);
   // header('location: index.php');
   echo $sql_delete;
} 
*/


$sql_select =  "SELECT * FROM tasks WHERE delete_time IS NULL";   
$res=$mysqli->query($sql_select);
$tasks=[];
while ($row = $res->fetch_object()) { 
    $tasks [] = $row;
}
?>  

<!DOCTYPE html>
<html>
    <head>
        <title>Todo List App</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
<body>
    <div class="heading">
        <h2 style="font-style: 'Hervetica';">ToDo List Application PHP and MySQL database</h2>
    </div>
    <form method='post' action='index.php' class='input_form'>
        <?php if (isset($errors)) { ?>
	    <p><?php echo $errors; ?></p>
        <?php } ?>
        <input type='text' name='task' class='task_input'>
        <button type='submit' name='submit' id='add_btn' class='add_btn'>Ajouter Tâche</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>Tâche n°</th>
                <th>Tâches</th>
                <th style="width: 60px;">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // select all tasks if page is visited or refreshed
            
            foreach ($tasks as $key => $value) : ?> 
                <form action="index.php" method="post">
                    <tr>
                        <td><?php echo $key ?></td>
                        <td class="task"><?php echo $value->task; ?></td>
                        
                        <td class="delete">
                            <a href="index.php?del_task=<?php echo $value->id; ?>">Fait</a>   
                        
                        <!--<input type="checkbox" name="done"/>  
                        </td>
                    <?//php endforeach ?>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="valider" value="Valider" />-->
                        </td>
                   </tr>               
                </form> 
                <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>