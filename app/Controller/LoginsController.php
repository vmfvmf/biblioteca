<?php   
    class LoginsController extends AppController{
        
        public  $name = "Logins";
        
        public function login() {
            //$this->set
            $this->Login->setDataSource(null);
            if ($this->data){    
                // Getting the datasource cache in the ConnectionManager object
                App::uses('ConnectionManager', 'Model');
                //$connectionManagerInstance = ConnectionManager::getInstance();
                $db = ConnectionManager::getDataSource("default");
                ////$databaseConfig = //&$connectionManagerInstance->_dataSources;
                // Changing the password so the credentials will fail
                pr($db);
                $db->config['password'] = $this->data["Login"]["senha"];
                $db->config['user'] = $this->data["Login"]["usuario"];

                // Getting the updated datasource
                //$connect = ConnectionManager::getDataSource('default');

                // Error handling when connection unavailable

/*                $conn = ConnectionManager::create('pg_con', 
                        array('datasource' => 'Database/Postgres',
                            'host' => 'localhost',
                            'login' => ,
                            'password' => $this->data["Login"]["senha"],
                            'database' => 'biblioteca'));
                $this->setDataSource($conn);
  */          }
        }
        
    }      
?>