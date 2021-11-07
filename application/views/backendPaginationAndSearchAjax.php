<!DOCTYPE html>
<html>
    <head>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.11.0/datatables.min.js"></script>

        <link href="<?php echo base_url('public/css/sb-admin-2.min.css'); ?>" rel="stylesheet">
        <style>
            .searchBoxClass{
                outline: none !important;
                border:2px solid green;
                box-shadow: 0 0 10px #719ECE;
            }
            .searchBoxClass:focus{
                outline: none !important;
                border:2px solid blue;
                box-shadow: 0 0 10px #719ECE;
            }
        </style>
      
    </head>

    <body>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary"></h6>                       
            </div>
            <div class="card-body">
                <div style="text-align: center">
                    <input type="button" value="Backend Pagination And Search By Ajax" onclick="backendPaginationAndSearchAjax(1,'');"/>
                </div>
            </div>
        </div>


        <br><br><br>

        <div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Backend Pagination And Search By Ajax</h6>                    
			</div>
		    <div class="card-body">
				<div style="text-align: center">
                    <!-- For per Page Options -->
                    <div style="float: left; padding:10px;" id="perPageOption"></div>

                    <!-- For Search -->
                    <div style="float: right; padding:10px;" id="searchId" name="searchName" class="searchClass">
                        <input type="text" placeholder="Search" id="searchBoxId" name="searchBoxName" class="searchBoxClass" size="30" style="padding-right:30px; margin-bottom:20px;">
                        <span style="margin-left:-30px;margin-top:-5px;"> <img src="<?php echo base_url('public/img/search.png'); ?>" alt="Search" width="20" height="20"> </span>
                                            
                    </div>
                    
                    <!-- Table -->
                    <div id="tableData"></div>
                    
                    <!-- For Page Page Link -->
                    <div id ="pglink" style="float: right; padding-top:10px;"></div>

				</div>
		    </div>

		</div>

    <script>
        function backendPaginationAndSearchAjax(pgNum,searchText){

            setCookie("selectedPage", pgNum, 1);

            let perPg=$('#perPage').find(":selected").val();


            let tableHtml='<table class="table table-bordered table-sm table-hover" id="table2Id" width="100%" cellspacing="0">';
            let tableHead="<thead><tr><th>Patient ID</th><th>Name</th></tr></thead>";
            let tableBody="<tbody>";


            $.ajax({
                url:"<?php echo base_url('BackendPaginationAjaxController/backendPaginationAndSearchAjax');?>",
                data:{pgNum:pgNum,perPg:perPg,searchText:searchText},
                type:"POST",
                success:function(RespondedData) {  
                    //alert(RespondedData);
                    let decodedData=JSON.parse(RespondedData);
                    
                    $('#pglink').html(decodedData['pageLink']);
                    $('#perPageOption').html(decodedData['perPageOptions']);

                    $(document).ready(function() {
                            $('#perPage').on('change', function(){
                                let selectedPage=getCookie("selectedPage");
                                backendPaginationAndSearchAjax(selectedPage,searchText);
                        });   
                    });
                    

                    for(let i=0; i<decodedData['tableData'].length; i++){
                        tableBody+="<tr>";
                        tableBody+="<td>";
                        tableBody+=decodedData['tableData'][i]['cCode'];
                        tableBody+="</td>";
                        tableBody+="<td>";
                        tableBody+=decodedData['tableData'][i]['cName'];
                        tableBody+="</td>";
                        tableBody+="</tr>";
                            
                    }
                    tableBody+="</tbody>";  

                    tableHtml+=tableHead;
                    tableHtml+=tableBody;
                    tableHtml+="</table>";
                    
                    $('#tableData').html(tableHtml);

                
                
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    console.log(XMLHttpRequest);
                    console.log(errorThrown);
                }
            });       


            }

    </script>



        <script>
            // -------------------------Cookie-------------------

            function setCookie(cname, cvalue, exdays) {
                const d = new Date();
                d.setTime(d.getTime() + (exdays*24*60*60*1000));
                let expires = "expires="+ d.toUTCString();
                document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
                }
                function getCookie(cname){
                let name = cname + "=";
                let decodedCookie = decodeURIComponent(document.cookie);
                let ca = decodedCookie.split(';');
                for(let i = 0; i <ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                    }
                    if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                    }
                }
                return "";
                }
                function deleteCookie(cname) {
                    document.cookie = cname+"=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                }


                $('#searchBoxId').keyup(function(){
                    var searchText=$(this).val();
                    backendPaginationAndSearchAjax(1,searchText.trim(' ')); 
                })
                
        </script>

    </body>


</html>