<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/reset_form.js"></script>
                            <script>
function clearFields(){
        document.getElementById("t1").value="";
        return false;
    }
</script>
</head>
<style>
body {
  background-color: #282828;
}
h3 {
  color: #bcba3e;
  text-align: center;
}
tr {
  color: white;
}
th {
color:#bcba3e;
}
</style>
<body>
    <div class="container">
    		<div class="row">
                <div class="span12">
                  <center>
    			    <h3>Physicans Associates Session Notes</h3>
            </center>
                </div>
    		</div>

        <div class="span12">
                    <form id="form2" class="form-search pull-right" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
                        <input id="t1" type="text" name="query" class="input-medium search-query" value="<?php echo isset($_GET['query'])?$_GET['query']:'';?>">
                        <button type="submit" class="btn">Search</button>
                        <input type=reset value="Clear" class="btn btn-custom" onClick="return a=clearFields()">
                    </form>
                </div>
			<div class="row">
                <div class="span12">
				<table class="table table-bordered">
		              <thead>
		                <tr>
                      <th>Session note</th>
		                  <th>course</th>
		                  <th>Read</th>
		                 <!-- <th>URL</th>
		                  <th>Author</th> 
		                   <th>Case Text</th>
		                  <th>Year</>
		                  <th>Email</th>
		                  <th>Read</th>-->
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

                       //create filer

                       $filter = "FROM notes " ;
                       $filter .= "JOIN category ON notes.category_id = category.id ";
                       $filter .= "WHERE (name LIKE :query OR urlCode LIKE :query) ";
                       $filter .= "AND category_id = 2; ";

                        //build query for count
                       $sql = "SELECT count(*)  ";
                       $sql .= $filter; 
                       //$sql .= "FROM notes " ;
                       //$sql .= "JOIN category ON notes.category_id = category.id ";
                       //$sql .= "WHERE (name LIKE :query OR urlCode LIKE :query) ";
                       //$sql .= "AND category_id = 2; ";

                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();
                       $paginator->paginate($sth->fetchColumn());

                       //build query for list
                       $sql = "SELECT urlCode, notes.name, category.course ";
                        $sql .= $filter; 
                       //$sql .= "FROM notes " ;
                       //$sql .= "JOIN category ON notes.category_id = category.id ";
                       //$sql .= "WHERE (name LIKE :query OR urlCode LIKE :query) ";
                       //$sql .= "AND category_id = 2; ";
                       $sql .= "ORDER BY id ASC "; 
                       $sql .= "LIMIT :start, :length ";
                       //$sql .= "WHERE name LIKE :query OR administrator LIKE :query OR category_id LIKE :query ";
                       
                       
                   
                       $start = (($paginator->getCurrentPage()-1)*$paginator->itemsPerPage);
                       $length = ($paginator->itemsPerPage);
                       

                       $sth = $pdo->prepare($sql);
                       $sth->bindParam(':start',$start,PDO::PARAM_INT);
                       $sth->bindParam(':length',$length,PDO::PARAM_INT);
                       $sth->bindParam(':query',$query,PDO::PARAM_STR);
                       $sth->execute();
                        //echo "hello";
                       //echo '['.$sql.$start.$length.']';

	 				   foreach ($sth->fetchAll(PDO::FETCH_ASSOC) as $row) {
						   		echo '<tr>';
							   	//echo '<td>'. $row['id'] . '</td>';
							   	echo '<td>'. $row['name'] . '</td>';
							   	//echo '<td>'. $row['administrator'] . '</td>';
							   	//echo '<td>'. $row['urlCode'] . '</td>';
							 	//echo '<td>'. $row['caseText'] . '</td>';
							   	//echo '<td>'. $row['year'] . '</td>';
							   	//echo '<td>'. $row['email'] . '</td>';
                  echo '<td>'. $row['course'] . '</td>';
							   	echo '<td width=350>';
                  echo '<a class="btn btn-custom" href="uploads/'.$row["urlCode"].'"target="_blank">read</a>';                
                  //echo '<a class="btn" href="read.php?id='.$row['id'].'">Read</a>';
                  //echo '&nbsp;';
                  //echo '<a class="btn btn-success" href="updateSept-thurs.php?id='.$row['id'].'">Update</a>';
                  //echo '&nbsp;';
                   //echo '<a class="btn btn-warning" href="uploadPA1.php?id='.$row['id'].'">Upload</a>';
                   //echo '&nbsp;';
                //echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Delete</a>';
                   
                //echo '<a class="btn btn-warning" href="ExportGIFTthurs.php?id='.$row['id'].'">Export</a>';
                
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