<?php
require_once "koneksi.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_prod_pend_perbulan()
   {
      global $connect;      
      $query = oci_parse($connect,"SELECT * FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN");            
      oci_execute($query);
      while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
         {
            $data[] =$row; 
         }
      $response=array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );
      header('Content-Type: application/json');
      echo json_encode($response);
   }   
//http://localhost/api/prod_pend_perbulan.php?function=prod_pend_perbulan 

   function get_prod_pend_perbulan_id()
   {
      global $connect;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }     

      $query = oci_parse($connect,"SELECT * FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE id= $id");       
    
      oci_execute($query);
      while(($row = oci_fetch_array($query, OCI_BOTH)) != false)
         {
            $data[] =$row; 
         }
           
      if($data)
      {
      $response = array(
                     'status' => 1,
                     'message' =>'Success',
                     'data' => $data
                  );               
      }else {
         $response=array(
                     'status' => 0,
                     'message' =>'No Data Found'
                  );
      }
      
      header('Content-Type: application/json');
      echo json_encode($response);   
   }
//http://localhost/api/prod_pend_perbulan.php?function=get_prod_pend_perbulan_id&id=1

   function insert_prod_pend_perbulan()
   {
      global $connect;   
      $check = array('id' => '','jenis_data' => '', 'lokasi' => '', 'tahun' => '', 'bulan' => '', 'shipcall' => '', 'gt' => '', 'jml_box' => '', 'jml_teus' => '', 'total_pendapatan' => '', 'tahun_departure' => '', 'bulan_departure' => '');
      $check_match = count(array_intersect_key($_POST, $check));
      if($check_match == count($check)){

         $query = "INSERT INTO DASHBOARDGRAFIK.PROD_PEND_PERBULAN(id,jenis_data,lokasi,tahun,bulan,shipcall,gt,jml_box,jml_teus,total_pendapatan,tahun_departure,bulan_departure) VALUES
         ('$_POST[id]', '$_POST[jenis_data]', '$_POST[lokasi]', '$_POST[tahun]', '$_POST[bulan]', '$_POST[shipcall]', '$_POST[gt]', '$_POST[jml_box]', '$_POST[jml_teus]', '$_POST[total_pendapatan]', '$_POST[tahun_departure]', '$_POST[bulan_departure]')";
         $statemen=oci_parse($connect,$query);
         oci_execute($statemen);
         oci_commit($connect);


         if($query)
         {
            $response=array(
               'status' => 1,
               'message' =>'Insert Success'
            );
         }
         else
         {
            $response=array(
               'status' => 0,
               'message' =>'Insert Failed.'
            );
         }
      }else{
         $response=array(
            'status' => 0,
            'message' =>'Wrong Parameter'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

//http://localhost/api/prod_pend_perbulan.php?function=insert_prod_pend_perbulan

   function update_prod_pend_perbulan()
   {
      global $connect;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }   
      $check = array('jenis_data' => '', 'lokasi' => '', 'tahun' => '', 'bulan' => '', 'shipcall' => '', 'gt' => '', 'jml_box' => '', 'jml_teus' => '', 'total_pendapatan' => '', 'tahun_departure' => '', 'bulan_departure' => '');
      $check_match = count(array_intersect_key($_POST, $check));         
      if($check_match == count($check)){

         $query = "UPDATE DASHBOARDGRAFIK.PROD_PEND_PERBULAN SET             
         jenis_data = '$_POST[jenis_data]',
         lokasi = '$_POST[lokasi]',
         tahun = '$_POST[tahun]',
         bulan = '$_POST[bulan]',
         shipcall = '$_POST[shipcall]',
         gt = '$_POST[gt]',
         jml_box = '$_POST[jml_box]',
         jml_teus = '$_POST[jml_teus]',
         total_pendapatan = '$_POST[total_pendapatan]',
         tahun_departure = '$_POST[tahun_departure]',
         bulan_departure = '$_POST[bulan_departure]' WHERE id = $id";

         $statemen=oci_parse($connect,$query);
         oci_execute($statemen,OCI_DEFAULT);
         oci_commit($connect);

         if($query)
         {
            $response=array(
               'status' => 1,
               'message' =>'Update Success'                  
            );
         }
         else
         {
            $response=array(
               'status' => 0,
               'message' =>'Update Failed'                  
            );
         }
      }else{
         $response=array(
            'status' => 0,
            'message' =>'Wrong Parameter',
            'data'=> $id
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

//http://localhost/api/prod_pend_perbulan.php?function=update_prod_pend_perbulan&id=1

   function delete_prod_pend_perbulan()
   {
      global $connect;
      $id = $_GET['id'];
      $query = "DELETE FROM DASHBOARDGRAFIK.PROD_PEND_PERBULAN WHERE id=".$id;
      $statemen=oci_parse($connect,$query);
      oci_execute($statemen,OCI_DEFAULT);
      oci_commit($connect);

      if($statemen)
      {
         $response=array(
            'status' => 1,
            'message' =>'Delete Success'
         );
      }
      else
      {
         $response=array(
            'status' => 0,
            'message' =>'Delete Fail.'
         );
      }
      header('Content-Type: application/json');
      echo json_encode($response);
   }

//http://localhost/api/prod_pend_perbulan.php?function=delete_prod_pend_perbulan&id=1

?>