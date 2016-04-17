<?php

    /**
     * Created by PhpStorm.
     * User: albert
     * Date: 17/11/15
     * Time: 18:57
     */
    class Database extends PDO
    {
        public function __construct($DB_TYPE, $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS)
        {
            parent::__construct(DB_TYPE . ':host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASS);

            //parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTIONS);
        }

        /**
         * @param string   $sql       une chaine sql
         * @param array    $array     Parametres a (bind)
         * @param constant $fetchMode Pdo Fetch mode
         * @return mixed
         */
        public function select($sql, $array = [], $fetchMode = PDO::FETCH_ASSOC)
        {
            $sth = $this->prepare($sql);
            foreach ($array as $key => $value) {
                $sth->bindValue("$key", $value);
            }

            $sth->execute();

            return $sth->fetchAll($fetchMode);
        }

        /**
         * @param string  $table nom de la table ou inserer les trucs ;)
         * @param  string $data  tableau associatif (array)Va sur WIKIPEDIA
         */
        public function insert($table, $data)
        {
            ksort($data);

            $fieldNames = implode('`, `', array_keys($data));
            $fieldValues = ':' . implode(', :', array_keys($data));

            $sth = $this->prepare("INSERT INTO $table (`$fieldNames`) VALUES ($fieldValues)");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            $sth->execute();
        }

        /**
         * @param string  $table nom de la table ou inserer les trucs ;)
         * @param  string $data  tableau associatif (array)Va sur WIKIPEDIA
         * @param string  $data  remplacement du WHERE sql
         */
        public function update($table, $data, $where)
        {
            ksort($data);

            $fieldDetails = NULL;
            foreach ($data as $key => $value) {
                $fieldDetails .= "`$key`=:$key,";
            }
            $fieldDetails = rtrim($fieldDetails, ',');

            $sth = $this->prepare("UPDATE $table SET $fieldDetails WHERE $where");

            foreach ($data as $key => $value) {
                $sth->bindValue(":$key", $value);
            }

            $sth->execute();
        }

        /**
         * @param   string $table
         * @param   string $where
         * @param int      $limit
         * @return int Lignes affectées
         */
        public function delete($table, $where, $and, $limit = 1)
        {
            return $this->exec("DELETE FROM $table WHERE $where AND $and LIMIT $limit");
        }


    }