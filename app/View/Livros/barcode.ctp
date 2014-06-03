<?php 
            $data_to_encode = '999999'; 

            // Generate Barcode data 
            $barcode = $this->Barcode->barcode(); 
            //$barcode
                    $this->Barcode->setType('C128'); 
            //$barcode
                    $this->Barcode->setCode($data_to_encode); 
            //$barcode
                    $this->Barcode->setSize(80,200); 

            // Generate filename             
            $random = rand(0,1000000); 
            $file = 'img/barcode/code_'.$random.'.png'; 

            // Generates image file on server             
            //$barcode
                    $this->Barcode->writeBarcodeFile($file); 

            // Display image 
            echo $this->Html->image('barcode/code_'.$random.'.png');
            ?>