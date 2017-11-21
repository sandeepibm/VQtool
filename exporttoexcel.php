<?php
include("connect.php");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
//echo 'Connected successfully';
//mysql_close($link);

  // establish database connection
  //
  //$conn = mysql_connect( 'localhost', 'root', 'root123' ) or die( mysql_error( ) );
  //mysql_select_db( 'inv', $conn ) or die( mysql_error( $conn ) );
  //
  // execute sql query
  //
  $query = sprintf( "SELECT concat(B.Name,'(',B.Email,')') Resource, monthname( A.CreatedOn ) Month, A.Status, A.Type, A.Subtype, A.CreatedOn StartDate, if( A.Status = 'Closed', A.UpdatedOn, NULL ) CloseDate, SLA_Days SLA, 
				if( A.Status = 'Closed', round(timestampdiff(Hour ,A.CreatedOn ,A.UpdatedOn)/24,1), NULL ) TAT, Escalated, concat('(',D.Sequence,')',D.Description) Severity,concat('(',C.Sequence,')',C.Description) Rating, RequestId, 1 count
				FROM ((allrequests A left join tblrating C on A.Rating = C.Id) left join tblseverity D on  A.Severity = D.Id), (SELECT Name,Email,UserGroup FROM userdata U UNION SELECT Name,Email,UserGroup FROM histuser H) B 
				WHERE A.AssignedTo = B.Email
				AND (B.UserGroup='Admin' OR B.UserGroup='Super User' OR B.UserGroup='Super User & Manager')
				ORDER BY 1 , 2, 3, 4, 5, 11" );
  $result = mysql_query($query) or die( mysql_error( ) );
  //
  // send response headers to the browser
  // following headers instruct the browser to treat the data as a csv file called export.csv
  //
  
  header( 'Content-Type: text/csv' );
  header( 'Content-Disposition: attachment;filename=VQ Tool Report extract on '.date('d-m-y').'.csv' );
  //
  // output header row (if atleast one row exists)
  //
  $row = mysql_fetch_assoc( $result );
  if ( $row )
  {
    echocsv( array_keys( $row ) );
  }
  //
  // output data rows (if atleast one row exists)
  //
  while ( $row )
  {
    echocsv( $row );
    $row = mysql_fetch_assoc( $result );
  }
  //
  // echocsv function
  //
  // echo the input array as csv data maintaining consistency with most CSV implementations
  // * uses double-quotes as enclosure when necessary
  // * uses double double-quotes to escape double-quotes 
  // * uses CRLF as a line separator
  //
  function echocsv( $fields )
  {
    $separator = '';
    foreach ( $fields as $field )
    {
      if ( preg_match( '/\\r|\\n|,|"/', $field ) )
      {
        $field = '"' . str_replace( '"', '""', $field ) . '"';
      }
      echo $separator . $field;
      $separator = ',';
    }
    echo "\r\n";
  }
  
  ?>
  <?php
//
//** Include path **/
//ini_set('include_path', ini_get('include_path').';../Classes/');

/** PHPExcel */
//include 'PHPExcel.php';

/** PHPExcel_Writer_Excel2007 */
//include 'PHPExcel/Writer/Excel2007.php';

//$save_as_name = $results_itunes[TABLE__ITUNES__TITLE].".xlsx";

//$new_save_as_name = str_replace(" ", "", $save_as_name);

// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
//$objPHPExcel->getActiveSheet()->setTitle('Simple');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
//$objPHPExcel->setActiveSheetIndex(0);

//$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->save(str_replace('.php', '.xlsx', __FILE__));

//testing renaming the excel sheet being produced after metadata is submitted....
//$objWriter->save($results_itunes[TABLE__ITUNES__TITLE].".xlsx");
//$objWriter->save($new_save_as_name);
/*
//ini_set('include_path', ini_get('include_path').';../Classes/');
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';

/*
$objPHPExcel = new PHPExcel('abc.xlsm');



// Create new PHPExcel object$objPHPExcel = new PHPExcel();
$objPHPExcel->getProperties()->setCreator("RSC Operation Team");
$objPHPExcel->getProperties()->setLastModifiedBy("RSC Operation Team");
$objPHPExcel->getProperties()->setTitle("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setSubject("Office 2007 XLSX Test Document");
$objPHPExcel->getProperties()->setDescription("Report generated from Automated Operation Requests.");

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Hello');
$objPHPExcel->getActiveSheet()->SetCellValue('B2', 'world!');
$objPHPExcel->getActiveSheet()->setTitle('Data');

$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
$objWriter->save('Automated Operation Request Report.xlsx');

// The Excel file that you want to convert to CSV
$input_xlsm = 'abc.xlsm';
 
// The file to which you want to export the CSV data
$output_csv = 'regular_csv_document_'.time().'.csv';
 
// This opens the Excel file with PHPExcel and then exports it to CSV
$objPHPExcel = PHPExcel_IOFactory::load($input_xlsm);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'CSV');
$objWriter->save($output_csv);

*/
?>