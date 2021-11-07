<!DOCTYPE html>
<html>
    <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.0/datatables.min.js"></script> -->

    <link href="<?php echo base_url('public/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
	<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.0/datatables.min.css"/> -->

      
    </head>

    <body>

        <style>
            .tb3, .tb3Th, .tb3Td {
            border:1px solid black;
            }
            
            .center {
            margin: auto;
            width: 60%;
            border: 3px solid #73AD21;
            padding-top: 20px;
            padding-left: 20px;
            padding-right: 20px;
            padding-bottom: 55px;
            }
        </style>

<!-- ------------------------- CodeIgniter Pagination --------------------------------------- -->
        
        <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">CodeIgniter Pagination Example (Backend)</h6>                       
                        </div>
                        <div class="card-body">

                        <div class="table-responsive">


                            <div style="width:60%; text-align:center;" class="center">

                                <table style="width:100%" class="tb3">


                                <tr>
                                    <th class="tb3Th">Center Id</th>
                                    <th class="tb3Th">Center Name</th>
                                </tr>

                                <?php if (is_array($data) || is_object($data)){ foreach ($data as $row){?>

                                <tr>
                                    <td class="tb3Td"><?php echo $row['cCode']; ?></td>
                                    <td class="tb3Td"><?php echo $row['cName']; ?></td>
                                </tr>

                                <?php } } ?>

                                </table>
                            
                                <div style="float: right; padding-top:10px;">
                                    <?php echo($this->pagination->create_links()); ?>
                                </div>
                            </div>


                                                
                        </div>

                </div>

                </div>
            </div>


    </body>

</html>
