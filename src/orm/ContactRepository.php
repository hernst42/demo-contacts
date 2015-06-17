<?php
/**
 * definition of class ContactRepository
 *
 * @version    $Id$
 */

namespace hernst42\orm;

/**
 * class to manage the contacts
 */
class ContactRepository
{

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @param \PDO $db
     */
    public function __construct(\PDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param string[] $conditions list of conditions indexed by their database column name
     *
     * @return array
     */
    public function findByConditions(array $conditions)
    {
        $sql = 'SELECT * FROM `Contacts`';
        $sqlConditions = [];
        $binds         = [];
        foreach ($conditions as $field => $value) {
            // prevent SQL injections via keys
            if (!preg_match('/^\w+$/', $field)) {
                throw new \InvalidArgumentException("invalid field given!");
            }
            $sqlConditions[] = "`$field` LIKE :$field";
            $binds[':' . $field] = $value;
        }
        if (count($conditions) > 0) {
            $sql .= ' WHERE ' . implode(' AND ', $sqlConditions);
        }
        $stm = $this->db->prepare($sql);
        $stm->execute($binds);
        $result = $stm->fetchAll(\PDO::FETCH_ASSOC);
        return $result;
    }

    /**
     * enable the given contact in the database
     *
     * @param int $id
     */
    public function enable($id)
    {
        $sql = 'UPDATE `Contacts` SET `Active` = \'Y\' WHERE PK = :id';
        $stm = $this->db->prepare($sql);
        $stm->execute([':id' => $id]);
    }

    /**
     * disable the given contact in the database
     *
     * @param int $id
     */
    public function disable($id)
    {
        $sql = 'UPDATE `Contacts` SET `Active` = \'N\' WHERE PK = :id';
        $stm = $this->db->prepare($sql);
        $stm->execute([':id' => $id]);
    }
}
