<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
     
     <div class="container">
        <div class="row d-flex justify-content-center my-4">
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-hover table-responsive text-center table-dark">
                    <thead>
                        <tr>
                            <th>srno</th>
                            <th>student name</th>
                            <th>student mobile</th>
                            <th>student email</th>
                            <th>student password</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("connection.php");
                        $limit=3;

                        
                        if(isset($_GET['page_no'])){
                            $pageno=$_GET['page_no'];
                        }else{
                            $pageno=1;
                        }
                        $offset=($pageno-1)*$limit;
                        $data=$conn->query("SELECT * FROM student ORDER BY stu_id DESC LIMIT {$offset},{$limit}");
                        if($data->num_rows>0){
                            $i=1;
                            while($row=$data->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?= $row['stu_id'] ?></td>
                            <td><?= $row['student_name'] ?></td>
                            <td><?= $row['student_mobile'] ?></td>
                            <td><?= $row['student_email'] ?></td>
                            <td><?= $row['student_pss'] ?></td>
                        </tr>
                        <?php
                            }
                        }else{
                        ?>
                        <tr>
                            <td colspan="20" class="text-center">Data Not Found</td>
                        </tr>
                        <?php
                        }
                        ?>

                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col col-md-12 d-flex justify-content-center">
                <ul class="pagination">
            <?php
             $data=$conn->query("select * from student");
             if($data->num_rows>0){
                $total_record=$data->num_rows;
                // $limit=3;
                if(isset($_GET['page_no'])){
                    $page_no=$_GET['page_no'];
                }else{
                    $page_no=1;
                }
                
                $total_pages=ceil($total_record/$limit);
                if($page_no > 1){
                    echo ' <li class="page-item"><a class="page-link" href="index.php?page_no='.($page_no-1).'">Previous</a></li>';
                }
                for($i=1;$i<=$total_pages;$i++){
            ?>
            
                <li class="page-item">
                    <a href="index.php?page_no=<?= $i ?>" class="page-link <?= ($i==$page_no)?'active bg-primary text-white':'text-dark' ?>"><?= $i ?></a>
                </li>
            <?php
                }
                if($total_pages > $page_no){
                    echo ' <li class="page-item"><a class="page-link" href="index.php?page_no='.($page_no+1).'">next</a></li>';
                }
            }
            ?>
             </ul>
            </div>

        
            
            </div>

            
        </div>
     </div>
    
  </body>
</html>