<?php
	
	 require "../DBManager.php";
	 require "../Admin 0/functions.php";
   require_once 'adminSynch.php';

	 $record_per_page = 5;  
	 $page = '';  
	 $output = '';  
	 if(isset($_POST["page"]))  
	 {  
	      $page = $_POST["page"];  
	 }  
	 else  
	 {  
	      $page = 1;  
	 }  
	 $start_from = ($page - 1)*$record_per_page; 
	  $pdo = pdo_connect_mysql();
	
	$stmt = $pdo->prepare("SELECT procomp.procomp_id AS 'pro', procomp.amount AS amount, procomp.cost AS cost, 'procomp' AS type, procomp.image AS image, procomp.pro_name AS pro_name, company.name as 'com_cl'
        FROM procomp
        INNER JOIN company ON procomp.com_id = company.com_id
        UNION
        SELECT proclient.proclient_id AS 'pro', proclient.amount AS amount, proclient.cost AS cost, 'proclient' AS type, proclient.image AS image, proclient.pro_name AS pro_name, client.username as 'com_cl'
         FROM proclient
         INNER JOIN client ON proclient.client_id = client.client_id
         LIMIT {$start_from},{$record_per_page}");
  $stmt->execute();
  $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $output = '';
   $output .= '  
      <tr>
                                        <th>No</th>
                                        <th>Image</th>
                                        <th>Name of Product</th>
                                        <th>Status</th>
                                        <th>Company/Client</th>
                                        <th>Number</th>
                                        <th>Type</th>
                                        <th>Price</th>
                                        <th>Setting</th>
                                    </tr> 
 ';  
  $count = 0;
   foreach ($result as $pro){
   	   	$output.='<tr id="'.$pro['pro'].'">
     <td>'.$pro['pro'].'</td>
     <td><img src="../'.$pro['image'].'" alt="" /></td>
     <td>'.$pro['pro_name'].'</td>
     <td>';
     if($pro['amount']>0){
     $output.='<button class="pd-setting">Active</button>';
     } else{
      $outp.='<button class="pd-setting">Non active</button>';
     }  
      $output.='</td>';
      $output.='
       <td>'.$pro['com_cl'].'</td>
       <td>'.$pro['amount'].'</td>
       <td>'.$pro['type'].'</td>
       <td>'.$pro['cost'].' $'.'</td>';
       $output.=' <td>
       <button data-toggle="tooltip" title="Email" class="pd-setting-ed delete" id="'.$pro['pro'].'" name="'.$pro['type'].'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
           <button data-toggle="tooltip" title="Delete" class="pd-setting-ed" id="'.$pro['pro'].'" name="'.$pro['type'].'"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
         </td>
        </tr>';

   }

    $pdo = pdo_connect_mysql();
 	 $stmt1 = $pdo->prepare("SELECT procomp.procomp_id AS 'pro', procomp.amount AS amount, procomp.cost AS cost, 'procomp' AS type, procomp.image AS image, procomp.pro_name AS pro_name, company.name as 'com_cl'
        FROM procomp
        INNER JOIN company ON procomp.com_id = company.com_id
        UNION
        SELECT proclient.proclient_id AS 'pro', proclient.amount AS amount, proclient.cost AS cost, 'proclient' AS type, proclient.image AS image, proclient.pro_name AS pro_name, client.username as 'com_cl'
         FROM proclient
         INNER JOIN client ON proclient.client_id = client.client_id");
  $stmt1->execute();
  $page_result = $stmt1->fetchAll(PDO::FETCH_ASSOC); 
 $total_records = $pdo->query("SELECT procomp.procomp_id AS 'pro', procomp.amount AS amount, procomp.cost AS cost, 'procomp' AS type, procomp.image AS image, procomp.pro_name AS pro_name, company.name as 'com_cl'
        FROM procomp
        INNER JOIN company ON procomp.com_id = company.com_id
        UNION
        SELECT proclient.proclient_id AS 'pro', proclient.amount AS amount, proclient.cost AS cost, 'proclient' AS type, proclient.image AS image, proclient.pro_name AS pro_name, client.username as 'com_cl'
         FROM proclient
         INNER JOIN client ON proclient.client_id = client.client_id")->rowCount(); 
 $total_pages = ceil($total_records/$record_per_page);
 for($i=1; $i<=$total_pages; $i++)  
 {  
      $output .=  "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>"; 
 }  
   
 echo $output;  


?>