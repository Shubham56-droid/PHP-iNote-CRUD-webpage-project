<?php

$insert = false;
$insertupdate = false;
$delete = false;



$servername = "localhost";
$username = "root";
$password = "";
$database = "curd";

$conn = mysqli_connect($servername,$username,$password,$database);

if(!$conn)
{
    die("Sorry failed to connect something went wrong<br>".mysqli_connect_error());
}


if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `note` WHERE `sno` = $sno ";
  $result = mysqli_query($conn,$sql);

  
}



if($_SERVER['REQUEST_METHOD']=='POST')
{
      if(isset($_POST["snoedit"]))
      {
        // update the  record
        $sno = $_POST["snoedit"];
        $title = $_POST["titleedit"];
        $description = $_POST["descriptionedit"];


        $sql = "UPDATE `note` SET `title` = '$title' , `description` = '$description' WHERE `note`.`sno` = $sno";
        $result = mysqli_query($conn,$sql);

        if($result)
        {
          $insertupdate = true;
        }
       

      }
      
      else
      {
        $title = $_POST['title'];
        $description = $_POST['description'];

        $sql = "INSERT INTO `note`(`title`,`description`) VALUES('$title','$description')";
        $result = mysqli_query($conn,$sql);

        if($result)
        {
            $insert = true;
        }

      }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iNote- to do list website</title>
    <!----------------------------------CSS LINK---------------------------------------------------------------------------------------------------------------------------------------------------------------------->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="note.css">


</head>
<body>

<!----------------------------------MODAL ---------------------------------------------------------------->
<!-- Button trigger modal -->
<!---<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal">
  Edit Modal
</button>--->

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

    <form  action="/php-shubham/note.php" method="POST">
    <input type="hidden" name="snoedit"  id="snoedit">
        <div class="form-group">
          <label for="title">Note Title</label>
          <input type="text" class="form-control" id="titleedit"  name="titleedit"  aria-describedby="emailHelp" placeholder="Enter title">
        </div>
        <div class="form-group">
          <label for="description">Note Description</label>
          <textarea class="form-control" id="descriptionedit" name="descriptionedit"    placeholder="Enter description" rows="3"></textarea>
        </div>
        
        <button type="submit" class="btn btn-primary">Update Note</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </form>



      </div>
    
    </div>
  </div>
</div>

<!--------------------------------------------------------------------Nav-Bar----------------------------------------------------------------------------------------------------------------------------------------->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="note.php"><strong>iNotes <img src="notes.png" alt="icon" style="height:40px;  width=45px;"></strong></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="note.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.html">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.html">Contact me</a>
      </li>
     
    </ul>
  </div>
</nav>
<!--------------------------------------------------------------------Nav-Bar----------------------------------------------------------------------------------------------------------------------------------------->
<?php
if($insert)
{
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success!</strong> Your note has been ADDED successfully.
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>';
}
?>

<?php

if($insertupdate)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your note has been UPDATED successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>

<?php

if($delete)
{
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your note has been DELETED successfully.
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}
?>
<!-------------------------------------------------------------form php------------------------------------------------------------------------------------------------------------->
<div class="containerform  my-4">
<h1>Add a Note <img src="notes.png" alt="icon" style="height:40px;  width=45px;"></h1>
<form  action="/php-shubham/note.php" method="POST">
  <div class="form-group">
    <label for="title">Note Title</label>
    <input type="text" class="form-control" id="title"  name="title"  aria-describedby="emailHelp" placeholder="Enter title">

  </div>
  <div class="form-group">
    <label for="description">Note Description</label>
    <textarea class="form-control" id="description" name="description"    placeholder="Enter description" rows="3"></textarea>
  </div>
  
  <button type="submit" class="btn btn-primary">Add Note</button>
</form>
</div>
<!-------------------------------------------------------------form php------------------------------------------------------------------------------------------------------------->
<div class="containertable my-4">
<table class="table" id="myTable">
<thead>
    <tr>
      <th scope="col">Sno</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Action</th>
    </tr>
</thead>
<tbody>
       
   <?php
        $sql = "SELECT * FROM `note`";
        $result = mysqli_query($conn,$sql);
        $sno = 1;
        while( $row = mysqli_fetch_assoc($result))
        {
        
        echo "<tr>
        <th scope='row'>".$row['sno']."</th>
        <td>".$row['title']."</td>
        <td>".$row['description']."</td>
        <td> <button class='edit btn btn-sm btn-primary' id=".$row['sno'].">Edit</button>  <button class='delete btn btn-sm btn-primary' id=d".$row['sno'].">Delete</button> </td>
        </tr>  ";

        $sno = $sno + 1; 
       }
    ?>
</tbody>
</table>
</div>

<div class="contentg">
</div>
<!-----------------------------------javascript------------------------------------------------------------------------------------------------------------------------------------------------------------>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>

<script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
<script>
  edits = document.getElementsByClassName('edit');
  Array.from(edits).forEach((element)=>{ 
  element.addEventListener("click",(e)=>{
  console.log("edit");
  tr = e.target.parentNode.parentNode;
  title = tr.getElementsByTagName("td")[0].innerText;
  description = tr.getElementsByTagName("td")[1].innerText;
  console.log(title,description);
  titleedit.value = title;
  descriptionedit.value = description;
  snoedit.value = e.target.id;
  console.log(e.target.id)
  $('#editModal').modal('toggle');
  })
  })


  deletes = document.getElementsByClassName('delete');
  Array.from(deletes).forEach((element)=>{ 
  element.addEventListener("click",(e)=>{
  console.log("edit");
  sno = e.target.id.substr(1,);
  
  if(confirm("Press OK to Delete!"))
  {
    console.log("yes");
    window.location = `/php-shubham/note.php?delete= ${sno}`;
    // create  a form to post the request to submit the form
    
  }
  else
  {
    console.log("no");
  }
  })
  })
 </script>
<!-----------------------------------javascript------------------------------------------------------------------------------------------------------------------------------------------------------------>
</body>
</html>
