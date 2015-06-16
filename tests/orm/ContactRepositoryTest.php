<?php
/**
 * @version    $Id$
 */

namespace hernstTest\orm;

use \hernst42\orm\ContactRepository;

/**
 * test for ContactRepositoryTest
 */
class ContactRepositoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var \hernst42\orm\ContactRepository
     */
    protected $object;

    /**
     * @var \PDO
     */
    private $db;

    /**
     * @covers \hernst42\orm\ContactRepository::findByConditions
     */
    public function testFindByConditions()
    {
        $records = $this->object->findByConditions(['Surname' => 'Eva']);
        $this->assertCount(1, $records);
        $records = $this->object->findByConditions([]);
        $this->assertCount(3, $records);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testFindByConditionsWithInvalidField()
    {
        $this->object->findByConditions(['; Select' => 'Eva']);
    }

    /**
     * @covers \hernst42\orm\ContactRepository::findByConditions
     * @covers \hernst42\orm\ContactRepository::disable
     */
    public function testDisable()
    {
        $this->object->disable(3);
        $records = $this->object->findByConditions(['PK' => 3]);
        $this->assertEquals('N', $records[0]['Active']);
    }

    /**
     * @covers \hernst42\orm\ContactRepository::findByConditions
     * @covers \hernst42\orm\ContactRepository::enable
     */
    public function testEnable()
    {
        $this->object->enable(1);
        $records = $this->object->findByConditions(['PK' => 1]);
        $this->assertEquals('Y', $records[0]['Active']);
    }

    /**
     * setup test object
     */
    protected function setUp()
    {
        parent::setUp();
        $this->db = new \PDO('mysql:host=localhost;dbname=hernst_demo', 'hernst', 'hernst');
        $this->db->beginTransaction();
        $this->object = new ContactRepository($this->db);
    }

    /**
     * rollback the open database transaction
     */
    protected function tearDown()
    {
        parent::tearDown();
        $this->db->rollBack();
    }
}
