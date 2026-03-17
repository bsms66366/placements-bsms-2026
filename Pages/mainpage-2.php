<?php
require 'includes/sessionCheck.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <link   href=" https://cdn.bootcss.com/bootstrap-table/1.13.5/extensions/multiple-search/bootstrap-table-multiple-search.min.js">
    <script src="js/bootstrap.min.js"></script>
   <script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.0.js"></script>
    <script src="js/reset_form.js"></script>
    <script>
function clearFields(){
        document.getElementById("t1").value="";
        return false;
    }
</script>


</head>

<body>
    <div class="container">
  <!--     <style>
    div { 
      width: 50%;
      height: 200px;
      background-color: #00FF00; 
    }
  </style> -->

    		<div class="row">
                <div class="span12">
    			    <h3>Current Anatomy Session Notes.</h3>
                </div>
    		</div>
			<div class="row">

                <div class="span6">
                    <p>
                    <a href="home.php" class="btn btn-custom">Back</a>
                    <a href="fileform.php" class="btn btn-warning">Upload File</a>
                    <a href="videoform.php" class="btn btn-warning">Add video</a>
                    </p>
                </div>

                <div class="span6">
                    <form id="form2" class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                        <input id="t1" type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
                        <button type="submit" class="btn">Search</button>
                        <input type=reset value="Clear" class="btn btn-custom" onClick="return a=clearFields()">
                    </form>
                </div>

                <div class="span12">
				<table class="table table-bg-success table-bordered">
		              <thead>
		                <tr class="bg-primary">
		                  <th>Session note</th>
		                  <th>Course</th>
		                  <th>Administrator</th>
		                  <th>Actions</th>
		                </tr>
		              </thead>
		              <tbody>
		              <?php
                       include 'paginator.php';
                       include 'includes/database.php';
                       $pdo = Database::connect();
                       $filter = null ;
                       $paginator = new Paginator();
                       $query = isset($_GET['query'])?('%'.$_GET['query'].'%'):'%';


                       // Create filter string 
                       $filter = "FROM notes " ;
                       $filter .= "JOIN category ON category_id = category.id ";
                       $filter .= "WHERE notes.name LIKE :query OR notes.administrator LIKE :query OR notes.urlCode LIKE :query; ";
                       

                       // Build query for count
                       $sql = "SELECT count(*)  ";
                       $sql .= $filter; 
                      
                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();

                       // Pass row count to paginator
                       $paginator->paginate($sth->fetchColumn());


                       // Build query for list
                       $sql = "SELECT notes.id,
                                notes.name,
                                notes.administrator, 
                                notes.urlCode,
                                notes.video,
                                category.course ";
                       $sql .= $filter; 
                       $sql .= "ORDER BY id ASC "; 
                       $sql .= "LIMIT :start, :length ";
                       
                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       
                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':start',$start,PDO::PARAM_INT);
                       $sth->bindParam(':length',$length,PDO::PARAM_INT);
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();


	 				        foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
      
                    echo '<td>'. $row['name'] . '</td>';
                    echo '<td>'. $row['course'] . '</td>';
                    echo '<td>'. $row['administrator'] . '</td>';
                    echo '<td width=350>';
                    if (!empty($row["urlCode"])) {
                   echo '<a class="btn btn-custom" href="uploads/'.$row["urlCode"].'"target="_blank">Read</a>';
                    } 
                    if (!empty($row["video"])) {               
                   echo '<a class="btn btn-custom" href="'.$row["video"].'"target="_blank">View</a>'; 
                    } 
                   echo '&nbsp;';
                   echo '&nbsp;';
                   echo '<a class="btn btn-danger" href="deleting.php?id='.$row['id'].'">Delete</a>';
                    echo '</td>';
                    echo '</tr>';
              }
					   Database::disconnect();
					  ?>
				      </tbody>
	            </table>
                <?php
                echo $paginator->pageNav();
                ?>
                </div>
    	    </div>
    </div> <!-- /container -->
  </body>
</html>