<?php
    class spottingPDO {

        private $db;
        private $count;

        function __construct($dsn="mysql:host=127.0.0.1;dbname=a1600526", $user="heffalump", $password="eib7ahnee0Oode7ahm9veizeefa5tail") {
            $this -> db = new PDO($dsn, $user, $password);
            $this -> db -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this -> db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            $this -> count = 0;
        }

        function select_by_id($id) {
            $select_by_id_sql = 'SELECT * FROM observations WHERE id = :id;';
            $select_by_id_stmt = $this -> db -> prepare($select_by_id_sql);
            $select_by_id_stmt -> bindValue(':id', $id, PDO::PARAM_INT);
            $select_by_id_stmt -> execute();

            return $select_by_id_stmt -> fetch();
        }

        function delete_by_id($id) {
            $delete_sql = 'DELETE FROM observations WHERE id = :id;';
            $delete_stmt = $this -> db -> prepare($delete_sql);
            $delete_stmt -> bindValue(':id', $id, PDO::PARAM_INT);
            $delete_stmt -> execute();
        }

        function get_all() {
            $select_all_sql = 'SELECT * FROM observations';
            $select_all_stmt = $this -> db -> prepare($select_all_sql);
            $select_all_stmt -> execute();

            return $select_all_stmt -> fetchAll();
        }

        function save($observation) {
            $sql = 'INSERT INTO observations (spotter, amount, place, description, spot_time) VALUES (:spotter, :amount, :place, :description, :spot_time); ';
			$stmt = $this -> db -> prepare($sql);
			$stmt -> bindValue(':spotter', 		$observation -> spotter, 		PDO::PARAM_STR);
			$stmt -> bindValue(':amount', 		$observation -> amount, 		PDO::PARAM_INT);
			$stmt -> bindValue(':place',		$observation -> place, 			PDO::PARAM_STR);
			$stmt -> bindValue(':description',	$observation -> description, 	PDO::PARAM_STR);
			$stmt -> bindValue(':spot_time',	$observation -> date, 			PDO::PARAM_STR);
			$stmt -> execute();
        }

        function search_by_name($q) {
            $query = '%'.$q.'%';

            $select_by_id_sql = 'SELECT * FROM observations WHERE spotter LIKE :q;';
            $select_by_id_stmt = $this -> db -> prepare($select_by_id_sql);
            $select_by_id_stmt -> bindValue(':q', $query, PDO::PARAM_STR);
            $select_by_id_stmt -> execute();
            return $select_by_id_stmt -> fetchAll();
        }
}