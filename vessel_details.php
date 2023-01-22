<?php
require_once "koneksi.php";
   if(function_exists($_GET['function'])) {
         $_GET['function']();
      }   
   function get_vessel_details()
   {
      global $connect;      
      $query = oci_parse($connect,"SELECT * FROM DASHBOARDGRAFIK.VESSEL_DETAILS");            
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
//http://localhost/api/vessel_details.php?function=get_vessel_details 

   function get_vessel_details_id()
   {
      global $connect;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }     

      $query = oci_parse($connect,"SELECT * FROM DASHBOARDGRAFIK.VESSEL_DETAILS WHERE id= $id");       
    
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
//http://localhost/api/vessel_details.php?function=get_vessel_details_id&id=1

   function insert_vessel_details()
   {
      global $connect;   
      $check = array('id' => '','ves_id' => '','agent' => '','shipper' => '', 'ocean_interisland' => '', 'ves_name' => '', 'in_voyage' => '', 'out_voyage' => '', 'ves_service' => '', 'berth_fr_metre' => '', 'berth_to_metre' => '', 'discharge' => '', 'load' => '', 'est_berth_ts' => '', 'act_berth_ts' => '', 'est_start_work_ts' => '', 'act_start_work_ts' => '', 'est_end_work_ts' => '', 'act_end_work_ts' => '', 'est_dep_ts' => '', 'act_dep_ts' => '');
      $check_match = count(array_intersect_key($_POST, $check));
      if($check_match == count($check)){

         $query = "INSERT INTO DASHBOARDGRAFIK.VESSEL_DETAILS(id,agent,nama_agent,jenis_data,lokasi,tahun,bulan,shipcall,gt,jml_box,jml_teus,total_pendapatan,tahun_departure,bulan_departure) VALUES
         ('$_POST[id]', '$_POST[ves_id]','$_POST[agent]', '$_POST[shipper]','$_POST[ocean_interisland]', '$_POST[ves_name]', '$_POST[bulan]', '$_POST[shipcall]', '$_POST[gt]', '$_POST[jml_box]', '$_POST[jml_teus]', '$_POST[total_pendapatan]', '$_POST[tahun_departure]', '$_POST[bulan_departure]')";
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

//http://localhost/api/vessel_details.php?function=insert_vessel_details

   function update_vessel_details()
   {
      global $connect;
      if (!empty($_GET["id"])) {
         $id = $_GET["id"];      
      }   
      $check = array('jenis_data' => '','agent' => '','nama_agent' => '', 'lokasi' => '', 'tahun' => '', 'bulan' => '', 'shipcall' => '', 'gt' => '', 'jml_box' => '', 'jml_teus' => '', 'total_pendapatan' => '', 'tahun_departure' => '', 'bulan_departure' => '');
      $check_match = count(array_intersect_key($_POST, $check));         
      if($check_match == count($check)){

         $query = "UPDATE DASHBOARDGRAFIK.VESSEL_DETAILS SET             
         jenis_data = '$_POST[jenis_data]',
         agent = '$_POST[agent]',
         nama_agent = '$_POST[nama_agent]',
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

//http://localhost/api/vessel_details.php?function=update_vessel_details&id=1

   function delete_vessel_details()
   {
      global $connect;
      $id = $_GET['id'];
      $query = "DELETE FROM DASHBOARDGRAFIK.VESSEL_DETAILS WHERE id=".$id;
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

//http://localhost/api/vessel_details.php?function=delete_vessel_details&id=1

?>