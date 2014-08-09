<?php



/**
 * This class defines the structure of the 'Tag' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 * @package    propel.generator.utils.model.map
 */
class TagTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'utils.model.map.TagTableMap';

	/**
	 * Initialize the table attributes, columns and validators
	 * Relations are not initialized by this method since they are lazy loaded
	 *
	 * @return     void
	 * @throws     PropelException
	 */
	public function initialize()
	{
		// attributes
		$this->setName('Tag');
		$this->setPhpName('Tag');
		$this->setClassname('Tag');
		$this->setPackage('utils.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NOMBRE', 'Nombre', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('NovedadTag', 'NovedadTag', RelationMap::ONE_TO_MANY, array('id' => 'idTag', ), null, 'CASCADE', 'NovedadTags');
		$this->addRelation('Novedad', 'Novedad', RelationMap::MANY_TO_MANY, array(), null, 'CASCADE', 'Novedads');
	} // buildRelations()

} // TagTableMap
