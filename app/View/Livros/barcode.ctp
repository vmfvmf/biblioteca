<?php 
            $data_to_encode = '100013'; 

            // Generate Barcode data 
            $this->Barcode->barcode(); 
            $this->Barcode->setType('C128'); 
            $this->Barcode->setCode($data_to_encode); 
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