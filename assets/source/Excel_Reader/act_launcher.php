<?php

require_once 'Excel/reader.php';
$data = new Spreadsheet_Excel_Reader();
	$data->setColumnFormat(3,'%.0f');
	$data->setColumnFormat(2,'%s');
	$data->setColumnFormat(1,'%s');



if(isset($_FILES['filelauncher']))
		{
		$uploadfile = $excelPath."/".str_replace(" ","_",basename($_FILES['filelauncher']['name']));
		$filename=basename($_FILES['filelauncher']['name']);
		 if(move_uploaded_file($_FILES['filelauncher']['tmp_name'],$uploadfile))
			{		
				$arrsender="";
				$arrmessage="";
				$arrmsisdn="";
				$arrdatesent=$attributes['date_sent'];

				if(file_exists($uploadfile))
				{
					$data->read($uploadfile);
					$ctr=0;
					for ($j = 1; $j< $data->sheets[0]['numRows']; $j++)
					{
						if($data->sheets[0]['cells'][$j+1][1]=="")
						{
								$Aarrsender[]=$data->sheets[0]['cells'][$j+1][1];
								$Aarrmsisdn[]=$data->sheets[0]['cells'][$j+1][3];
								$Aarrmessage[]=$data->sheets[0]['cells'][$j+1][2];
						}
						if($data->sheets[0]['cells'][$j+1][3]=="")
						{
								$Barrsender[]=$data->sheets[0]['cells'][$j+1][1];
								$Barrmsisdn[]=$data->sheets[0]['cells'][$j+1][3];
								$Barrmessage[]=$data->sheets[0]['cells'][$j+1][2];
						}
						
						if($data->sheets[0]['cells'][$j+1][2]=="")
						{
								$Carrsender[]=$data->sheets[0]['cells'][$j+1][1];
								$Carrmsisdn[]=$data->sheets[0]['cells'][$j+1][3];
								$Carrmessage[]=$data->sheets[0]['cells'][$j+1][2];
						}
						if(($data->sheets[0]['cells'][$j+1][1]!="")&&($data->sheets[0]['cells'][$j+1][3]!="")&&($data->sheets[0]['cells'][$j+1][2]!=""))
						{
								$arrsender[]=$data->sheets[0]['cells'][$j+1][1];
								$arrmsisdn[]=$data->sheets[0]['cells'][$j+1][3];
								$arrmessage[]=$data->sheets[0]['cells'][$j+1][2];	

						}
						
										$ctr++;

										sleep(1/10);
				}
			  }


			}
			else
			{
					print "Cannot Upload File";
			}
			
		}

				//for ($j = 0; $j<$ctr; $j++)
				//{
						//$db->Execute("INSERT INTO t_queue(id_sender,msisdn,message,date_created,created_by,date_sent) VALUES('".$arrsender[$j]."','".$arrmsisdn[$j]."','".$arrmessage[$j]."','".DATE('Y-m-d H:i:s')."','".$_SESSION['id']."','".$attributes['date_sent']."')");

						//$db->Execute("INSERT INTO t_report (sender_id,msisdn,message,date_created,date_sent,sent_by) VALUES ('".$arrsender[$j]."','".$arrmsisdn[$j]."','".$arrmessage[$j]."','".DATE('Y-m-d H:i:s')."','".$attributes['date_sent']."','".$_SESSION['id']."')");



						//sleep(1/10);
						
				//}



unlink($uploadfile);


?>