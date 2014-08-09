<?php



/**
 * This class defines the structure of the 'Archivo' table.
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
class ArchivoTableMap extends TableMap
{

	/**
	 * The (dot-path) name of this class
	 */
	const CLASS_NAME = 'utils.model.map.ArchivoTableMap';

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
		$this->setName('Archivo');
		$this->setPhpName('Archivo');
		$this->setClassname('Archivo');
		$this->setPackage('utils.model');
		$this->setUseIdGenerator(true);
		// columns
		$this->addPrimaryKey('ID', 'Id', 'INTEGER', true, null, null);
		$this->addColumn('NOMBREORIGINAL', 'NombreOriginal', 'VARCHAR', true, 255, null);
		$this->addColumn('NOMBREREFERENCIA', 'NombreReferencia', 'VARCHAR', true, 255, null);
		$this->addColumn('MIME', 'Mime', 'VARCHAR', true, 255, null);
		$this->addColumn('SIZE', 'Size', 'VARCHAR', true, 255, null);
		// validators
	} // initialize()

	/**
	 * Build the RelationMap objects for this table relationships
	 */
	public function buildRelations()
	{
		$this->addRelation('NovedadImagenChica', 'NovedadImagenChica', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
		$this->addRelation('NovedadImagenGrande', 'NovedadImagenGrande', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
		$this->addRelation('NovedadArchivo', 'NovedadArchivo', RelationMap::ONE_TO_ONE, array('id' => 'id', ), 'CASCADE', null);
	} // buildRelations()

} // ArchivoTableMap
