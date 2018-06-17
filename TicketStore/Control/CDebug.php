<?php

class CDebug {
    
    public function getDebug() {
        $db = USingleton::getInstance('FDBmanager');
        $sql = "SELECT codo FROM ordine ORDER BY codo DESC LIMIT 1";
        $result = $db->getConnection()->query($sql);
        $rows = $result->fetchAll(PDO::FETCH_COLUMN,0);
        
        echo "<pre>";
        print_r($rows);
        echo "</pre>";
        echo "pippo";
    }
}
