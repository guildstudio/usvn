<?php
// Call USVN_Db_Table_Row_GroupTest::main() if this source file is executed directly.
if (!defined("PHPUnit_MAIN_METHOD")) {
    define("PHPUnit_MAIN_METHOD", "USVN_Db_Table_Row_ProjectTest::main");
}

require_once "PHPUnit/Framework/TestCase.php";
require_once "PHPUnit/Framework/TestSuite.php";

require_once 'www/USVN/autoload.php';


/**
 * Test class for USVN_Db_Table_Row_Group.
 * Generated by PHPUnit_Util_Skeleton on 2007-04-18 at 14:39:49.
 */
class USVN_Db_Table_Row_ProjectTest extends USVN_Test_DB {
	private $projectTable;
	private $project;
	private $projectid;
	private $groups;

	/**
     * Runs the test methods of this class.
     *
     * @access public
     * @static
     */
    public static function main() {
        require_once "PHPUnit/TextUI/TestRunner.php";

        $suite  = new PHPUnit_Framework_TestSuite("USVN_Db_Table_Row_ProjectTest");
        $result = PHPUnit_TextUI_TestRunner::run($suite);
    }

    public function setUp() {
		parent::setUp();
		$this->projectTable = new USVN_Db_Table_Projects();
		$this->project = $this->projectTable->fetchNew();
		$this->project->projects_name = 'test';
		$this->project->projects_start_date = '2007-04-01 15:29:57';
		$this->projectid = $this->project->save();

		$this->groups = new USVN_Db_Table_Groups();
		$group = $this->groups->insert(
			array(
				"groups_id" => 4,
				"groups_name" => "test",
				"groups_description" => "test"
			)
		);
		$this->groups->insert(
			array(
				"groups_id" => 5,
				"groups_name" => "test2",
				"groups_description" => "test2"
			)
		);
		$this->groups->insert(
			array(
				"groups_id" => 6,
				"groups_name" => "test3",
				"groups_description" => "test3"
			)
		);
    }

    public function testProject()
	{
		$this->assertEquals('test', $this->project->projects_name);
		$this->assertEquals('test', $this->project->name);
	}

	public function testAddGroup()
	{
		$this->project->addGroup($this->groups->find(4)->current());
		$this->project->addGroup($this->groups->find(5)->current());
		$this->groups = $this->project->findManyToManyRowset('USVN_Db_Table_Groups', 'USVN_Db_Table_Workgroups');
		$res = array();
		foreach ($this->groups as $group) {
			array_push($res, $group->groups_name);
		}
		$this->assertContains("test", $res);
		$this->assertContains("test2", $res);
		$this->assertNotContains("notest", $res);
	}

	public function testGroupIsMember()
	{
		$group = $this->groups->find(4)->current();
		//$this->assertFalse($this->project->groupIsMember($group));
		$this->project->addGroup($group);
		$this->assertTrue($this->project->groupIsMember($group));
	}
}

// Call USVN_Db_Table_Row_GroupTest::main() if this source file is executed directly.
if (PHPUnit_MAIN_METHOD == "USVN_Db_Table_Row_ProjectTest::main") {
    USVN_Db_Table_Row_ProjectTest::main();
}
?>