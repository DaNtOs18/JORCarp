<?php

class InvoicesUtils
{

    function uploadCustomersData()
    {
        include_once "DBUtils.php";
        $dbUtils = new DBUtils();
        $uploadTo = '../Files/';
        $uploadCustomersFile = $uploadTo . basename($_FILES['customersFile']['name']);
        move_uploaded_file($_FILES['customersFile']['tmp_name'], $uploadCustomersFile);
        $_SESSION["fileDirectory"] = $uploadCustomersFile;
        $customers = $this->exportCustomersFromExcel($uploadCustomersFile);
        $dbUtils->insertCustomersDatas($customers);
        $_SESSION["fileUploaded"] = true;
    }

    function exportCustomersFromExcel($customersFileName)
    {
        require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load($customersFileName);
        $objWorksheet = $objPHPExcel->getActiveSheet();

        $highestRow = $objWorksheet->getHighestRow();
        $highestColumn = $objWorksheet->getHighestColumn();

        $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);
        $rows = array();
        $customers = array();
        for ($row = 1; $row <= $highestRow; ++$row) {
            for ($col = 0; $col <= $highestColumnIndex; ++$col) {
                $rows[$col] = $objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
                array_push($rows, $rows[$col]);
            }

            $customer = ["name"=>$rows[1],"nif"=>$rows[2],"address1"=>$rows[0],"address2"=>$rows[3]];
            $customer2 = ["name"=>$rows[6],"nif"=>$rows[7],"address1"=>$rows[5],"address2"=>$rows[8]];

            if ($customer["nif"] != null) array_push($customers, $customer);
            if ($customer2["nif"] != null)  array_push($customers, $customer2);
        }
        $customers = array_filter($customers);
        return $customers;
    }

    function uploadInvoiceData(){
        if(isset($_GET["idcliente"])){
            if(isset($_POST["quantities"])) $quantities = $_POST["quantities"];
            if(isset($_POST["descriptions"])) $descriptions = $_POST["descriptions"];
            if(isset($_POST["unitprices"])) $unitPrices = $_POST["unitprices"];
            if(isset($_POST["amounts"])) $amounts = $_POST["amounts"];
            if(isset($_POST["grosstotal"])) $grossTotal = $_POST["grosstotal"];
            if(isset($_POST["igic"])) $igic = $_POST["igic"];
            if(isset($_POST["total"])) $total = $_POST["total"];
            $notion = array();
            $totals = array();
            $invoice = array();
            for ($i=0;$i<sizeof($amounts);$i++){
                if($amounts[$i]!=""&&$amounts[$i]>0){
                    $notion = ["quantity"=>$quantities[$i],"description"=>$descriptions[$i],
                        "unitPrice"=>$unitPrices[$i],"amount"=>$amounts[$i]];
                    $invoice["notions"][$i]=$notion;
                }
            }
            if($grossTotal!=""&&$grossTotal>0){
                $totals = ["grossTotal"=>$grossTotal,"igic"=>$igic,"total"=>$total];
                $invoice["totals"]=$totals;
            }
            echo "<pre>";
            var_dump($invoice);
            echo "</pre>";
        }
    }
}
