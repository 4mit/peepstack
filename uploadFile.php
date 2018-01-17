<?php 
 
$conn = mysqli_connect("localhost", "root", "", "excelupload");
 
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;
require_once 'Spout/Autoloader/autoload.php';

if (!empty($_FILES['file']['name'])) 
{
    $pathinfo = pathinfo($_FILES["file"]["name"]);
   if (($pathinfo['extension'] == 'xlsx') && $_FILES['file']['size'] > 0 ) 
   {
        $inputFileName = $_FILES['file']['tmp_name']; 
        $reader = ReaderFactory::create(Type::XLSX);
        $reader->open($inputFileName);
        $count = 1;
		
        foreach ($reader->getSheetIterator() as $sheet) {
            foreach ($sheet->getRowIterator() as $row) {
                if ($count > 1) { 
                    $data['name'] = $row[0];
                    $data['email'] = $row[1];
					
					$to = $data['email'];
					$subject = "Assingment";
					$txt = "This is sample Email";
					$headers = "From: amitamora@gmail.com" . "\r\n" .
					"CC: amitamora@gmail.com";

					$conn->query("INSERT INTO `data` VALUES ('{$data['name']}','{$data['email']}')");
				    if(mail($to,$subject,$txt,$headers)){
						echo 'Mail Sent Successfully';
					}
                }
                $count++;
            }
        }
        $reader->close();
    } else 
        echo "Please Select XLSX Excel File";
} else 
    echo "Please Select Excel File";
?>