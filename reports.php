<?php

  //Requiring root url that is defined as a constant
  require('config/rooturlconfig.php');
  
  //Requiring classes for database related tasks
  require('./classes/db_h.php');
  require('./classes/fetch_reports.php');

  //Fetching all the reports from db in $reports as array
  $fetch = new FetchReports();
  $reports = $fetch->getAllReports();
  
?>

<!--Getting header and navbar from components-->
<?php include('components/header.php'); ?>
<?php include('components/navbar.php'); ?>

<div class="mx-5">
        <div class="container p-4 mx-auto">
        <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Search by ID:</label>
                <input type="number" name="search_input" class="form-control" value="" placeholder="Enter ID">               
            </div>
            <input type="submit" class="btn btn-info btn-lg" name="search_btn" value="Search">      
        </form>
        </div>
        
        <table class="table table-hover table-striped px-3 " >
            <thead class="table-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Buyer</th>
                    <th scope="col">Receipt ID</th>
                    <th scope="col">Items</th>
                    <th scope="col">Buyer Email</th>
                    <th scope="col">Buyer IP</th>
                    <th scope="col">Note</th>
                    <th scope="col">City</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Entry at</th>
                    <th scope="col">Entry by</th>
                </tr>
            </thead>
            <tbody>
            <!--When id is not being searched then displaying all the data-->
            <?php if(!isset($_POST['search_btn'])) { 
                foreach($reports as $report) : 
            ?>
                <tr>
                    <td scope="row"><?php echo $report['id']; ?></th>
                    <td><?php echo $report['amount']; ?></td>
                    <td><?php echo $report['buyer']; ?></td>
                    <td><?php echo $report['receipt_id']; ?></td>
                    <td><?php echo $report['items']; ?></td>
                    <td><?php echo $report['buyer_email']; ?></td>
                    <td><?php echo $report['buyer_ip']; ?></td>
                    <td><?php echo $report['note']; ?></td>
                    <td><?php echo $report['city']; ?></td>
                    <td><?php echo $report['phone']; ?></td>
                    <td><?php echo $report['entry_at']; ?></td>
                    <td><?php echo $report['entry_by']; ?></td>
                </tr>
            <?php 
                endforeach; 
            } 
            //When report is being searched by user by ID
            else {

                //Get the ID from $_POST
                $tosearch_id = $_POST['search_input'];

                //Fetching searched report in the data
                $query_run = $fetch->getSearchedReport($tosearch_id);
                
               /*  ?>
            <?php */
                if(mysqli_num_rows($query_run)> 0) {
                    while($row = mysqli_fetch_array($query_run)) { 
            ?>
                <tr>
                    <td scope="row"><?php echo $row['id']; ?></th>
                    <td><?php echo $row['amount']; ?></td>
                    <td><?php echo $row['buyer']; ?></td>
                    <td><?php echo $row['receipt_id']; ?></td>
                    <td><?php echo $row['items']; ?></td>
                    <td><?php echo $row['buyer_email']; ?></td>
                    <td><?php echo $row['buyer_ip']; ?></td>
                    <td><?php echo $row['note']; ?></td>
                    <td><?php echo $row['city']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo $row['entry_at']; ?></td>
                    <td><?php echo $row['entry_by']; ?></td>
                </tr>
                
                <?php 
                    }
                }
                else {
                    
                    ?>
                    <tr>
                    <td class="text-center" colspan="12"><h3><?php echo "No data available"; ?></h3></td>
                    </tr>
                    <?php
                }
                //Unset the object created after work done
                unset($fetch);
                }?>
                
            </tbody>

        </table>     
</div>


<!--Getting footer from components-->
<?php include('components/footer.php'); ?>