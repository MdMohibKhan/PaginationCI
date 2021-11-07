<!DOCTYPE html>
<html>
    <head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.0/datatables.min.js"></script>

    <link href="<?php echo base_url('public/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.0/datatables.min.css"/>

      
    </head>

    <body>

        <style>
            
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



<!-- -------------------------First Method--------------------------------------- -->

    <?php 

        $data2=array(
            0=>array("cCode"=>"123","cName"=>"jhfiuh"),
            1=>array("cCode"=>"173","cName"=>"jhfiuh"),
            2=>array("cCode"=>"193","cName"=>"jhfiuh"),
            3=>array("cCode"=>"124","cName"=>"jhfiuh"),
            4=>array("cCode"=>"153","cName"=>"jhfiuh"),
            5=>array("cCode"=>"173","cName"=>"jhfiuh"),
            6=>array("cCode"=>"128","cName"=>"jhfiuh"),
            7=>array("cCode"=>"129","cName"=>"jhfiuh"),
            8=>array("cCode"=>"323","cName"=>"jhfiuh"),
            9=>array("cCode"=>"983","cName"=>"jhfiuh"),
            10=>array("cCode"=>"823","cName"=>"jhfiuh"),
            11=>array("cCode"=>"593","cName"=>"jhfiuh"),
            12=>array("cCode"=>"1723","cName"=>"jhfiuh"),
            13=>array("cCode"=>"1273","cName"=>"jhfiuh"),
            14=>array("cCode"=>"1234","cName"=>"jhfiuh"),
            15=>array("cCode"=>"1234","cName"=>"jhfiuh"),
            16=>array("cCode"=>"1237","cName"=>"jhfiuh"),
            17=>array("cCode"=>"1238","cName"=>"jhfiuh"),
            18=>array("cCode"=>"1239","cName"=>"jhfiuh"),
            19=>array("cCode"=>"1239","cName"=>"jhfiuh"),
            20=>array("cCode"=>"1234","cName"=>"jhfiuh"),
            21=>array("cCode"=>"1237","cName"=>"jhfiuh"),
            22=>array("cCode"=>"1234","cName"=>"jhfiuh"),
            23=>array("cCode"=>"1237","cName"=>"jhfiuh"),
            24=>array("cCode"=>"1237","cName"=>"jhfiuh"),
            25=>array("cCode"=>"123","cName"=>"jhfiuh"),
            26=>array("cCode"=>"123","cName"=>"jhfiuh"),
            27=>array("cCode"=>"123","cName"=>"jhfiuh"),
            28=>array("cCode"=>"123","cName"=>"jhfiuh"),
            29=>array("cCode"=>"123","cName"=>"jhfiuh"),
            30=>array("cCode"=>"123","cName"=>"jhfiuh"),
            31=>array("cCode"=>"123","cName"=>"jhfiuh"),
            32=>array("cCode"=>"123","cName"=>"jhfiuh"),
            33=>array("cCode"=>"123","cName"=>"jhfiuh"),
            34=>array("cCode"=>"123","cName"=>"jhfiuh"),
            35=>array("cCode"=>"123","cName"=>"jhfiuh"),
        );

    ?>


<!-- 1st Way -->
<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Pagination Example-1(Frontend)</h6>                       
				</div>
				<div class="card-body">
				<div class="table-responsive">

                    <div style="width:60%; text-align:center;" class="center">

										<table class="table table-bordered table-sm table-hover" id="table1Id" width="100%" cellspacing="0">
											<thead>
												<tr>
													<th>Patient ID</th>
													<th>Name</th>
													
												</tr>
											</thead>
										
											<tbody>
										
												<?php if(!$data2==null): foreach ($data2 as $pList):?>
												<tr>
													<td><?php echo $pList['cCode']; ?></td><!-- patientTid -->
													<td><?php echo ucwords($pList['cName']); ?></td>
													
												</tr>
												<?php endforeach; endif;?> 
											</tbody>
										</table>

                        </div>
				</div>

		</div>

		</div>
	</div>


<!--   Data Table 1-->
<script>
    jQuery(document).ready(function() {
        jQuery('#table1Id').DataTable();
    } );
</script>

    


<!-- -------------------------Second Method--------------------------------------- -->

<br><br><br>



<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary"></h6>                       
				</div>
				<div class="card-body">
				<div style="text-align: center">
					<input type="button" value="Pagination Table By Method 2" onclick="myFun();"/>
										
				</div>

		</div>

		</div>
	</div>



<br><br><br>



<!-- 2nd Way -->
<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Pagination Example-2(Frontend)</h6>                       
				</div>
				<div class="card-body">
				<div class="table-responsive">
                    <div style="width:60%; text-align:center;" class="center" id="tableContents">

                    </div>
					
										
				</div>

		</div>

		</div>
	</div>



    <script>
        function myFun(){
            let tableHtml='<table class="table table-bordered table-sm table-hover" id="table2Id" width="100%" cellspacing="0">';
            let tableHead="<thead><tr><th>Patient ID</th><th>Name</th></tr></thead>";
            let tableBody="<tbody>";


            $.ajax({
                url:"<?php echo base_url('FrontendPaginationController/paginationBootstrap');?>",
                type:"POST",
                success:function(RespondedData) {  
                    
                    let decodedData=JSON.parse(RespondedData);

                    for(let i=0; i<decodedData.length; i++){
                        tableBody+="<tr>";
                        tableBody+="<td>";
                        tableBody+=decodedData[i]['cCode'];
                        tableBody+="</td>";
                        tableBody+="<td>";
                        tableBody+=decodedData[i]['cName'];
                        tableBody+="</td>";
                        tableBody+="</tr>";
                            
                    }
                    tableBody+="</tbody>";  

                    tableHtml+=tableHead;
                    tableHtml+=tableBody;
                    tableHtml+="</table>";
                    
                    $('#tableContents').html(tableHtml);

                    // <!--   Data Table 2-->
                    jQuery(document).ready(function() {
                        jQuery('#table2Id').DataTable();
                    } );
                
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log(XMLHttpRequest);
                    console.log(errorThrown);
                }
            });   

										
                

        }
        

        </script>


    </body>

</html>
