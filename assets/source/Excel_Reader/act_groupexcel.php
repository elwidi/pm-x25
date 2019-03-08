<?php
require_once 'Excel/reader.php';
		$data = new Spreadsheet_Excel_Reader();
		$data->setColumnFormat(3,'%.0f');
		$data->setColumnFormat(2,'%s');
		$data->setColumnFormat(1,'%s');

		$uploadfile = $excelPath."/".str_replace(" ","_",basename($_FILES['excelfile']['name']));
	
		 if(move_uploaded_file($_FILES['excelfile']['tmp_name'],$uploadfile))
		 {					
				
					if(file_exists($uploadfile))
					{
						$data->read($uploadfile);
						$k=0;
						$l=0;
						 for ($j = 3; $j<= $data->sheets[0]['numRows']; $j++)
						{
							 $idgroup=$attributes['id'];

							 $sqlcheck="SELECT id_client FROM t_data_client WHERE handphone='".$data->sheets[0]['cells'][$j][12]."'";
							if(validasiEntry($db,$sqlcheck))
							{
								$datainvalid[$k]['idclient']=generateid();								
								$datainvalid[$k]['f_name']=$data->sheets[0]['cells'][$j][2];
								$datainvalid[$k]['m_name']=$data->sheets[0]['cells'][$j][3];
								$datainvalid[$k]['l_name']=$data->sheets[0]['cells'][$j][4];
								$datainvalid[$k]['gender']=$data->sheets[0]['cells'][$j][5];
								$datainvalid[$k]['date_of_birth']=$data->sheets[0]['cells'][$j][6];
								$datainvalid[$k]['address1']=$data->sheets[0]['cells'][$j][7];
								$datainvalid[$k]['address2']=$data->sheets[0]['cells'][$j][8];
								$datainvalid[$k]['address3']=$data->sheets[0]['cells'][$j][9];
								$datainvalid[$k]['city']=$data->sheets[0]['cells'][$j][10];
								$datainvalid[$k]['homephone']=$data->sheets[0]['cells'][$j][11];
								$datainvalid[$k]['handphone']=$data->sheets[0]['cells'][$j][12];
								$datainvalid[$k]['officephone']=$data->sheets[0]['cells'][$j][13];
								$datainvalid[$k]['fax']=$data->sheets[0]['cells'][$j][14];
								$datainvalid[$k]['occupation']=$data->sheets[0]['cells'][$j][15];
								$datainvalid[$k]['company']=$data->sheets[0]['cells'][$j][16];



								$k++;
							}
							else
							{
								$datavalid[$l]['idclient']=generateid();
								$datavalid[$l]['f_name']=$data->sheets[0]['cells'][$j][2];
								$datavalid[$l]['m_name']=$data->sheets[0]['cells'][$j][3];
								$datavalid[$l]['l_name']=$data->sheets[0]['cells'][$j][4];
								$datavalid[$l]['gender']=$data->sheets[0]['cells'][$j][5];
								$datavalid[$l]['date_of_birth']=$data->sheets[0]['cells'][$j][6];
								$datavalid[$l]['address1']=$data->sheets[0]['cells'][$j][7];
								$datavalid[$l]['address2']=$data->sheets[0]['cells'][$j][8];
								$datavalid[$l]['address3']=$data->sheets[0]['cells'][$j][9];
								$datavalid[$l]['city']=$data->sheets[0]['cells'][$j][10];
								$datavalid[$l]['homephone']=$data->sheets[0]['cells'][$j][11];
								$datavalid[$l]['handphone']=$data->sheets[0]['cells'][$j][12];
								$datavalid[$l]['officephone']=$data->sheets[0]['cells'][$j][13];
								$datavalid[$l]['fax']=$data->sheets[0]['cells'][$j][14];
								$datavalid[$l]['occupation']=$data->sheets[0]['cells'][$j][15];
								$datavalid[$l]['company']=$data->sheets[0]['cells'][$j][16];

								$l++;
							}


						}
					
					
			}
			 
		 }




?>