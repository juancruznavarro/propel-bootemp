<?php


/**
 * Base class that represents a row from the 'Archivo' table.
 *
 *
 *
 * @package    propel.generator.utils.model.om
 */
abstract class BaseArchivo extends BaseObject  implements Persistent
{

	/**
	 * Peer class name
	 */
	const PEER = 'ArchivoPeer';

	/**
	 * The Peer class.
	 * Instance provides a convenient way of calling static methods on a class
	 * that calling code may not be able to identify.
	 * @var        ArchivoPeer
	 */
	protected static $peer;

	/**
	 * The flag var to prevent infinit loop in deep copy
	 * @var       boolean
	 */
	protected $startCopy = false;

	/**
	 * The value for the id field.
	 * @var        int
	 */
	protected $id;

	/**
	 * The value for the nombreoriginal field.
	 * @var        string
	 */
	protected $nombreoriginal;

	/**
	 * The value for the nombrereferencia field.
	 * @var        string
	 */
	protected $nombrereferencia;

	/**
	 * The value for the mime field.
	 * @var        string
	 */
	protected $mime;

	/**
	 * The value for the size field.
	 * @var        string
	 */
	protected $size;

	/**
	 * @var        NovedadImagenChica one-to-one related NovedadImagenChica object
	 */
	protected $singleNovedadImagenChica;

	/**
	 * @var        NovedadImagenGrande one-to-one related NovedadImagenGrande object
	 */
	protected $singleNovedadImagenGrande;

	/**
	 * @var        NovedadArchivo one-to-one related NovedadArchivo object
	 */
	protected $singleNovedadArchivo;

	/**
	 * Flag to prevent endless save loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInSave = false;

	/**
	 * Flag to prevent endless validation loop, if this object is referenced
	 * by another object which falls in this transaction.
	 * @var        boolean
	 */
	protected $alreadyInValidation = false;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $novedadImagenChicasScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $novedadImagenGrandesScheduledForDeletion = null;

	/**
	 * An array of objects scheduled for deletion.
	 * @var		array
	 */
	protected $novedadArchivosScheduledForDeletion = null;

	/**
	 * Get the [id] column value.
	 *
	 * @return     int
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Get the [nombreoriginal] column value.
	 *
	 * @return     string
	 */
	public function getNombreOriginal()
	{
		return $this->nombreoriginal;
	}

	/**
	 * Get the [nombrereferencia] column value.
	 *
	 * @return     string
	 */
	public function getNombreReferencia()
	{
		return $this->nombrereferencia;
	}

	/**
	 * Get the [mime] column value.
	 *
	 * @return     string
	 */
	public function getMime()
	{
		return $this->mime;
	}

	/**
	 * Get the [size] column value.
	 *
	 * @return     string
	 */
	public function getSize()
	{
		return $this->size;
	}

	/**
	 * Set the value of [id] column.
	 *
	 * @param      int $v new value
	 * @return     Archivo The current object (for fluent API support)
	 */
	public function setId($v)
	{
		if ($v !== null) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = ArchivoPeer::ID;
		}

		return $this;
	} // setId()

	/**
	 * Set the value of [nombreoriginal] column.
	 *
	 * @param      string $v new value
	 * @return     Archivo The current object (for fluent API support)
	 */
	public function setNombreOriginal($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nombreoriginal !== $v) {
			$this->nombreoriginal = $v;
			$this->modifiedColumns[] = ArchivoPeer::NOMBREORIGINAL;
		}

		return $this;
	} // setNombreOriginal()

	/**
	 * Set the value of [nombrereferencia] column.
	 *
	 * @param      string $v new value
	 * @return     Archivo The current object (for fluent API support)
	 */
	public function setNombreReferencia($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->nombrereferencia !== $v) {
			$this->nombrereferencia = $v;
			$this->modifiedColumns[] = ArchivoPeer::NOMBREREFERENCIA;
		}

		return $this;
	} // setNombreReferencia()

	/**
	 * Set the value of [mime] column.
	 *
	 * @param      string $v new value
	 * @return     Archivo The current object (for fluent API support)
	 */
	public function setMime($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->mime !== $v) {
			$this->mime = $v;
			$this->modifiedColumns[] = ArchivoPeer::MIME;
		}

		return $this;
	} // setMime()

	/**
	 * Set the value of [size] column.
	 *
	 * @param      string $v new value
	 * @return     Archivo The current object (for fluent API support)
	 */
	public function setSize($v)
	{
		if ($v !== null) {
			$v = (string) $v;
		}

		if ($this->size !== $v) {
			$this->size = $v;
			$this->modifiedColumns[] = ArchivoPeer::SIZE;
		}

		return $this;
	} // setSize()

	/**
	 * Indicates whether the columns in this object are only set to default values.
	 *
	 * This method can be used in conjunction with isModified() to indicate whether an object is both
	 * modified _and_ has some values set which are non-default.
	 *
	 * @return     boolean Whether the columns in this object are only been set with default values.
	 */
	public function hasOnlyDefaultValues()
	{
		// otherwise, everything was equal, so return TRUE
		return true;
	} // hasOnlyDefaultValues()

	/**
	 * Hydrates (populates) the object variables with values from the database resultset.
	 *
	 * An offset (0-based "start column") is specified so that objects can be hydrated
	 * with a subset of the columns in the resultset rows.  This is needed, for example,
	 * for results of JOIN queries where the resultset row includes columns from two or
	 * more tables.
	 *
	 * @param      array $row The row returned by PDOStatement->fetch(PDO::FETCH_NUM)
	 * @param      int $startcol 0-based offset column which indicates which restultset column to start with.
	 * @param      boolean $rehydrate Whether this object is being re-hydrated from the database.
	 * @return     int next starting column
	 * @throws     PropelException  - Any caught Exception will be rewrapped as a PropelException.
	 */
	public function hydrate($row, $startcol = 0, $rehydrate = false)
	{
		try {

			$this->id = ($row[$startcol + 0] !== null) ? (int) $row[$startcol + 0] : null;
			$this->nombreoriginal = ($row[$startcol + 1] !== null) ? (string) $row[$startcol + 1] : null;
			$this->nombrereferencia = ($row[$startcol + 2] !== null) ? (string) $row[$startcol + 2] : null;
			$this->mime = ($row[$startcol + 3] !== null) ? (string) $row[$startcol + 3] : null;
			$this->size = ($row[$startcol + 4] !== null) ? (string) $row[$startcol + 4] : null;
			$this->resetModified();

			$this->setNew(false);

			if ($rehydrate) {
				$this->ensureConsistency();
			}

			return $startcol + 5; // 5 = ArchivoPeer::NUM_HYDRATE_COLUMNS.

		} catch (Exception $e) {
			throw new PropelException("Error populating Archivo object", $e);
		}
	}

	/**
	 * Checks and repairs the internal consistency of the object.
	 *
	 * This method is executed after an already-instantiated object is re-hydrated
	 * from the database.  It exists to check any foreign keys to make sure that
	 * the objects related to the current object are correct based on foreign key.
	 *
	 * You can override this method in the stub class, but you should always invoke
	 * the base method from the overridden method (i.e. parent::ensureConsistency()),
	 * in case your model changes.
	 *
	 * @throws     PropelException
	 */
	public function ensureConsistency()
	{

	} // ensureConsistency

	/**
	 * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
	 *
	 * This will only work if the object has been saved and has a valid primary key set.
	 *
	 * @param      boolean $deep (optional) Whether to also de-associated any related objects.
	 * @param      PropelPDO $con (optional) The PropelPDO connection to use.
	 * @return     void
	 * @throws     PropelException - if this object is deleted, unsaved or doesn't have pk match in db
	 */
	public function reload($deep = false, PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("Cannot reload a deleted object.");
		}

		if ($this->isNew()) {
			throw new PropelException("Cannot reload an unsaved object.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}

		// We don't need to alter the object instance pool; we're just modifying this instance
		// already in the pool.

		$stmt = ArchivoPeer::doSelectStmt($this->buildPkeyCriteria(), $con);
		$row = $stmt->fetch(PDO::FETCH_NUM);
		$stmt->closeCursor();
		if (!$row) {
			throw new PropelException('Cannot find matching row in the database to reload object values.');
		}
		$this->hydrate($row, 0, true); // rehydrate

		if ($deep) {
			// also de-associate any related objects?

			$this->singleNovedadImagenChica = null;

			$this->singleNovedadImagenGrande = null;

			$this->singleNovedadArchivo = null;

		} // if (deep)
	}

	/**
	 * Removes this object from datastore and sets delete attribute.
	 *
	 * @param      PropelPDO $con
	 * @return     void
	 * @throws     PropelException
	 * @see        BaseObject::setDeleted()
	 * @see        BaseObject::isDeleted()
	 */
	public function delete(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		try {
			$deleteQuery = ArchivoQuery::create()
			->filterByPrimaryKey($this->getPrimaryKey());
			$ret = $this->preDelete($con);
			if ($ret) {
				$deleteQuery->delete($con);
				$this->postDelete($con);
				$con->commit();
				$this->setDeleted(true);
			} else {
				$con->commit();
			}
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Persists this object to the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All modified related objects will also be persisted in the doSave()
	 * method.  This method wraps all precipitate database operations in a
	 * single transaction.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        doSave()
	 */
	public function save(PropelPDO $con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ArchivoPeer::DATABASE_NAME, Propel::CONNECTION_WRITE);
		}

		$con->beginTransaction();
		$isInsert = $this->isNew();
		try {
			$ret = $this->preSave($con);
			if ($isInsert) {
				$ret = $ret && $this->preInsert($con);
			} else {
				$ret = $ret && $this->preUpdate($con);
			}
			if ($ret) {
				$affectedRows = $this->doSave($con);
				if ($isInsert) {
					$this->postInsert($con);
				} else {
					$this->postUpdate($con);
				}
				$this->postSave($con);
				ArchivoPeer::addInstanceToPool($this);
			} else {
				$affectedRows = 0;
			}
			$con->commit();
			return $affectedRows;
		} catch (Exception $e) {
			$con->rollBack();
			throw $e;
		}
	}

	/**
	 * Performs the work of inserting or updating the row in the database.
	 *
	 * If the object is new, it inserts it; otherwise an update is performed.
	 * All related objects are also updated in this method.
	 *
	 * @param      PropelPDO $con
	 * @return     int The number of rows affected by this insert/update and any referring fk objects' save() operations.
	 * @throws     PropelException
	 * @see        save()
	 */
	protected function doSave(PropelPDO $con)
	{
		$affectedRows = 0; // initialize var to track total num of affected rows
		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;

			if ($this->isNew() || $this->isModified()) {
				// persist changes
				if ($this->isNew()) {
					$this->doInsert($con);
				} else {
					$this->doUpdate($con);
				}
				$affectedRows += 1;
				$this->resetModified();
			}

			if ($this->novedadImagenChicasScheduledForDeletion !== null) {
				if (!$this->novedadImagenChicasScheduledForDeletion->isEmpty()) {
					NovedadImagenChicaQuery::create()
					->filterByPrimaryKeys($this->novedadImagenChicasScheduledForDeletion->getPrimaryKeys(false))
					->delete($con);
					$this->novedadImagenChicasScheduledForDeletion = null;
				}
			}

			if ($this->singleNovedadImagenChica !== null) {
				if (!$this->singleNovedadImagenChica->isDeleted()) {
					$affectedRows += $this->singleNovedadImagenChica->save($con);
				}
			}

			if ($this->novedadImagenGrandesScheduledForDeletion !== null) {
				if (!$this->novedadImagenGrandesScheduledForDeletion->isEmpty()) {
					NovedadImagenGrandeQuery::create()
					->filterByPrimaryKeys($this->novedadImagenGrandesScheduledForDeletion->getPrimaryKeys(false))
					->delete($con);
					$this->novedadImagenGrandesScheduledForDeletion = null;
				}
			}

			if ($this->singleNovedadImagenGrande !== null) {
				if (!$this->singleNovedadImagenGrande->isDeleted()) {
					$affectedRows += $this->singleNovedadImagenGrande->save($con);
				}
			}

			if ($this->novedadArchivosScheduledForDeletion !== null) {
				if (!$this->novedadArchivosScheduledForDeletion->isEmpty()) {
					NovedadArchivoQuery::create()
					->filterByPrimaryKeys($this->novedadArchivosScheduledForDeletion->getPrimaryKeys(false))
					->delete($con);
					$this->novedadArchivosScheduledForDeletion = null;
				}
			}

			if ($this->singleNovedadArchivo !== null) {
				if (!$this->singleNovedadArchivo->isDeleted()) {
					$affectedRows += $this->singleNovedadArchivo->save($con);
				}
			}

			$this->alreadyInSave = false;

		}
		return $affectedRows;
	} // doSave()

	/**
	 * Insert the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @throws     PropelException
	 * @see        doSave()
	 */
	protected function doInsert(PropelPDO $con)
	{
		$modifiedColumns = array();
		$index = 0;

		$this->modifiedColumns[] = ArchivoPeer::ID;
		if (null !== $this->id) {
			throw new PropelException('Cannot insert a value for auto-increment primary key (' . ArchivoPeer::ID . ')');
		}

		// check the columns in natural order for more readable SQL queries
		if ($this->isColumnModified(ArchivoPeer::ID)) {
			$modifiedColumns[':p' . $index++]  = '`ID`';
		}
		if ($this->isColumnModified(ArchivoPeer::NOMBREORIGINAL)) {
			$modifiedColumns[':p' . $index++]  = '`NOMBREORIGINAL`';
		}
		if ($this->isColumnModified(ArchivoPeer::NOMBREREFERENCIA)) {
			$modifiedColumns[':p' . $index++]  = '`NOMBREREFERENCIA`';
		}
		if ($this->isColumnModified(ArchivoPeer::MIME)) {
			$modifiedColumns[':p' . $index++]  = '`MIME`';
		}
		if ($this->isColumnModified(ArchivoPeer::SIZE)) {
			$modifiedColumns[':p' . $index++]  = '`SIZE`';
		}

		$sql = sprintf(
			'INSERT INTO `Archivo` (%s) VALUES (%s)',
		implode(', ', $modifiedColumns),
		implode(', ', array_keys($modifiedColumns))
		);

		try {
			$stmt = $con->prepare($sql);
			foreach ($modifiedColumns as $identifier => $columnName) {
				switch ($columnName) {
					case '`ID`':
						$stmt->bindValue($identifier, $this->id, PDO::PARAM_INT);
						break;
					case '`NOMBREORIGINAL`':
						$stmt->bindValue($identifier, $this->nombreoriginal, PDO::PARAM_STR);
						break;
					case '`NOMBREREFERENCIA`':
						$stmt->bindValue($identifier, $this->nombrereferencia, PDO::PARAM_STR);
						break;
					case '`MIME`':
						$stmt->bindValue($identifier, $this->mime, PDO::PARAM_STR);
						break;
					case '`SIZE`':
						$stmt->bindValue($identifier, $this->size, PDO::PARAM_STR);
						break;
				}
			}
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), $e);
		}

		try {
			$pk = $con->lastInsertId();
		} catch (Exception $e) {
			throw new PropelException('Unable to get autoincrement id.', $e);
		}
		$this->setId($pk);

		$this->setNew(false);
	}

	/**
	 * Update the row in the database.
	 *
	 * @param      PropelPDO $con
	 *
	 * @see        doSave()
	 */
	protected function doUpdate(PropelPDO $con)
	{
		$selectCriteria = $this->buildPkeyCriteria();
		$valuesCriteria = $this->buildCriteria();
		BasePeer::doUpdate($selectCriteria, $valuesCriteria, $con);
	}

	/**
	 * Array of ValidationFailed objects.
	 * @var        array ValidationFailed[]
	 */
	protected $validationFailures = array();

	/**
	 * Gets any ValidationFailed objects that resulted from last call to validate().
	 *
	 *
	 * @return     array ValidationFailed[]
	 * @see        validate()
	 */
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	/**
	 * Validates the objects modified field values and all objects related to this table.
	 *
	 * If $columns is either a column name or an array of column names
	 * only those columns are validated.
	 *
	 * @param      mixed $columns Column name or an array of column names.
	 * @return     boolean Whether all columns pass validation.
	 * @see        doValidate()
	 * @see        getValidationFailures()
	 */
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	/**
	 * This function performs the validation work for complex object models.
	 *
	 * In addition to checking the current object, all related objects will
	 * also be validated.  If all pass then <code>true</code> is returned; otherwise
	 * an aggreagated array of ValidationFailed objects will be returned.
	 *
	 * @param      array $columns Array of column names to validate.
	 * @return     mixed <code>true</code> if all validations pass; array of <code>ValidationFailed</code> objets otherwise.
	 */
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


			if (($retval = ArchivoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


			if ($this->singleNovedadImagenChica !== null) {
				if (!$this->singleNovedadImagenChica->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->singleNovedadImagenChica->getValidationFailures());
				}
			}

			if ($this->singleNovedadImagenGrande !== null) {
				if (!$this->singleNovedadImagenGrande->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->singleNovedadImagenGrande->getValidationFailures());
				}
			}

			if ($this->singleNovedadArchivo !== null) {
				if (!$this->singleNovedadArchivo->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->singleNovedadArchivo->getValidationFailures());
				}
			}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	/**
	 * Retrieves a field from the object by name passed in as a string.
	 *
	 * @param      string $name name
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     mixed Value of field.
	 */
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		$field = $this->getByPosition($pos);
		return $field;
	}

	/**
	 * Retrieves a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @return     mixed Value of field at $pos
	 */
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getId();
				break;
			case 1:
				return $this->getNombreOriginal();
				break;
			case 2:
				return $this->getNombreReferencia();
				break;
			case 3:
				return $this->getMime();
				break;
			case 4:
				return $this->getSize();
				break;
			default:
				return null;
			break;
		} // switch()
	}

	/**
	 * Exports the object as an array.
	 *
	 * You can specify the key type of the array by passing one of the class
	 * type constants.
	 *
	 * @param     string  $keyType (optional) One of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 *                    BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 *                    Defaults to BasePeer::TYPE_PHPNAME.
	 * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
	 * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
	 * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
	 *
	 * @return    array an associative array containing the field names (as keys) and field values
	 */
	public function toArray($keyType = BasePeer::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
	{
		if (isset($alreadyDumpedObjects['Archivo'][$this->getPrimaryKey()])) {
			return '*RECURSION*';
		}
		$alreadyDumpedObjects['Archivo'][$this->getPrimaryKey()] = true;
		$keys = ArchivoPeer::getFieldNames($keyType);
		$result = array(
		$keys[0] => $this->getId(),
		$keys[1] => $this->getNombreOriginal(),
		$keys[2] => $this->getNombreReferencia(),
		$keys[3] => $this->getMime(),
		$keys[4] => $this->getSize(),
		);
		if ($includeForeignObjects) {
			if (null !== $this->singleNovedadImagenChica) {
				$result['NovedadImagenChica'] = $this->singleNovedadImagenChica->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
			}
			if (null !== $this->singleNovedadImagenGrande) {
				$result['NovedadImagenGrande'] = $this->singleNovedadImagenGrande->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
			}
			if (null !== $this->singleNovedadArchivo) {
				$result['NovedadArchivo'] = $this->singleNovedadArchivo->toArray($keyType, $includeLazyLoadColumns, $alreadyDumpedObjects, true);
			}
		}
		return $result;
	}

	/**
	 * Sets a field from the object by name passed in as a string.
	 *
	 * @param      string $name peer name
	 * @param      mixed $value field value
	 * @param      string $type The type of fieldname the $name is of:
	 *                     one of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME
	 *                     BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM
	 * @return     void
	 */
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ArchivoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	/**
	 * Sets a field from the object by Position as specified in the xml schema.
	 * Zero-based.
	 *
	 * @param      int $pos position in xml schema
	 * @param      mixed $value field value
	 * @return     void
	 */
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setId($value);
				break;
			case 1:
				$this->setNombreOriginal($value);
				break;
			case 2:
				$this->setNombreReferencia($value);
				break;
			case 3:
				$this->setMime($value);
				break;
			case 4:
				$this->setSize($value);
				break;
		} // switch()
	}

	/**
	 * Populates the object using an array.
	 *
	 * This is particularly useful when populating an object from one of the
	 * request arrays (e.g. $_POST).  This method goes through the column
	 * names, checking to see whether a matching key exists in populated
	 * array. If so the setByName() method is called for that column.
	 *
	 * You can specify the key type of the array by additionally passing one
	 * of the class type constants BasePeer::TYPE_PHPNAME, BasePeer::TYPE_STUDLYPHPNAME,
	 * BasePeer::TYPE_COLNAME, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_NUM.
	 * The default key type is the column's phpname (e.g. 'AuthorId')
	 *
	 * @param      array  $arr     An array to populate the object from.
	 * @param      string $keyType The type of keys the array uses.
	 * @return     void
	 */
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ArchivoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombreOriginal($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombreReferencia($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMime($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSize($arr[$keys[4]]);
	}

	/**
	 * Build a Criteria object containing the values of all modified columns in this object.
	 *
	 * @return     Criteria The Criteria object containing all modified values.
	 */
	public function buildCriteria()
	{
		$criteria = new Criteria(ArchivoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ArchivoPeer::ID)) $criteria->add(ArchivoPeer::ID, $this->id);
		if ($this->isColumnModified(ArchivoPeer::NOMBREORIGINAL)) $criteria->add(ArchivoPeer::NOMBREORIGINAL, $this->nombreoriginal);
		if ($this->isColumnModified(ArchivoPeer::NOMBREREFERENCIA)) $criteria->add(ArchivoPeer::NOMBREREFERENCIA, $this->nombrereferencia);
		if ($this->isColumnModified(ArchivoPeer::MIME)) $criteria->add(ArchivoPeer::MIME, $this->mime);
		if ($this->isColumnModified(ArchivoPeer::SIZE)) $criteria->add(ArchivoPeer::SIZE, $this->size);

		return $criteria;
	}

	/**
	 * Builds a Criteria object containing the primary key for this object.
	 *
	 * Unlike buildCriteria() this method includes the primary key values regardless
	 * of whether or not they have been modified.
	 *
	 * @return     Criteria The Criteria object containing value(s) for primary key(s).
	 */
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ArchivoPeer::DATABASE_NAME);
		$criteria->add(ArchivoPeer::ID, $this->id);

		return $criteria;
	}

	/**
	 * Returns the primary key for this object (row).
	 * @return     int
	 */
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	/**
	 * Generic method to set the primary key (id column).
	 *
	 * @param      int $key Primary key.
	 * @return     void
	 */
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	/**
	 * Returns true if the primary key for this object is null.
	 * @return     boolean
	 */
	public function isPrimaryKeyNull()
	{
		return null === $this->getId();
	}

	/**
	 * Sets contents of passed object to values from current object.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      object $copyObj An object of Archivo (or compatible) type.
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
	 * @throws     PropelException
	 */
	public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
	{
		$copyObj->setNombreOriginal($this->getNombreOriginal());
		$copyObj->setNombreReferencia($this->getNombreReferencia());
		$copyObj->setMime($this->getMime());
		$copyObj->setSize($this->getSize());

		if ($deepCopy && !$this->startCopy) {
			// important: temporarily setNew(false) because this affects the behavior of
			// the getter/setter methods for fkey referrer objects.
			$copyObj->setNew(false);
			// store object hash to prevent cycle
			$this->startCopy = true;

			$relObj = $this->getNovedadImagenChica();
			if ($relObj) {
				$copyObj->setNovedadImagenChica($relObj->copy($deepCopy));
			}

			$relObj = $this->getNovedadImagenGrande();
			if ($relObj) {
				$copyObj->setNovedadImagenGrande($relObj->copy($deepCopy));
			}

			$relObj = $this->getNovedadArchivo();
			if ($relObj) {
				$copyObj->setNovedadArchivo($relObj->copy($deepCopy));
			}

			//unflag object copy
			$this->startCopy = false;
		} // if ($deepCopy)

		if ($makeNew) {
			$copyObj->setNew(true);
			$copyObj->setId(NULL); // this is a auto-increment column, so set to default value
		}
	}

	/**
	 * Makes a copy of this object that will be inserted as a new row in table when saved.
	 * It creates a new object filling in the simple attributes, but skipping any primary
	 * keys that are defined for the table.
	 *
	 * If desired, this method can also make copies of all associated (fkey referrers)
	 * objects.
	 *
	 * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
	 * @return     Archivo Clone of current object.
	 * @throws     PropelException
	 */
	public function copy($deepCopy = false)
	{
		// we use get_class(), because this might be a subclass
		$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	/**
	 * Returns a peer instance associated with this om.
	 *
	 * Since Peer classes are not to have any instance attributes, this method returns the
	 * same instance for all member of this class. The method could therefore
	 * be static, but this would prevent one from overriding the behavior.
	 *
	 * @return     ArchivoPeer
	 */
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new ArchivoPeer();
		}
		return self::$peer;
	}


	/**
	 * Initializes a collection based on the name of a relation.
	 * Avoids crafting an 'init[$relationName]s' method name
	 * that wouldn't work when StandardEnglishPluralizer is used.
	 *
	 * @param      string $relationName The name of the relation to initialize
	 * @return     void
	 */
	public function initRelation($relationName)
	{
	}

	/**
	 * Gets a single NovedadImagenChica object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     NovedadImagenChica
	 * @throws     PropelException
	 */
	public function getNovedadImagenChica(PropelPDO $con = null)
	{

		if ($this->singleNovedadImagenChica === null && !$this->isNew()) {
			$this->singleNovedadImagenChica = NovedadImagenChicaQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleNovedadImagenChica;
	}

	/**
	 * Sets a single NovedadImagenChica object as related to this object by a one-to-one relationship.
	 *
	 * @param      NovedadImagenChica $v NovedadImagenChica
	 * @return     Archivo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNovedadImagenChica(NovedadImagenChica $v = null)
	{
		$this->singleNovedadImagenChica = $v;

		// Make sure that that the passed-in NovedadImagenChica isn't already associated with this object
		if ($v !== null && $v->getArchivo() === null) {
			$v->setArchivo($this);
		}

		return $this;
	}

	/**
	 * Gets a single NovedadImagenGrande object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     NovedadImagenGrande
	 * @throws     PropelException
	 */
	public function getNovedadImagenGrande(PropelPDO $con = null)
	{

		if ($this->singleNovedadImagenGrande === null && !$this->isNew()) {
			$this->singleNovedadImagenGrande = NovedadImagenGrandeQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleNovedadImagenGrande;
	}

	/**
	 * Sets a single NovedadImagenGrande object as related to this object by a one-to-one relationship.
	 *
	 * @param      NovedadImagenGrande $v NovedadImagenGrande
	 * @return     Archivo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNovedadImagenGrande(NovedadImagenGrande $v = null)
	{
		$this->singleNovedadImagenGrande = $v;

		// Make sure that that the passed-in NovedadImagenGrande isn't already associated with this object
		if ($v !== null && $v->getArchivo() === null) {
			$v->setArchivo($this);
		}

		return $this;
	}

	/**
	 * Gets a single NovedadArchivo object, which is related to this object by a one-to-one relationship.
	 *
	 * @param      PropelPDO $con optional connection object
	 * @return     NovedadArchivo
	 * @throws     PropelException
	 */
	public function getNovedadArchivo(PropelPDO $con = null)
	{

		if ($this->singleNovedadArchivo === null && !$this->isNew()) {
			$this->singleNovedadArchivo = NovedadArchivoQuery::create()->findPk($this->getPrimaryKey(), $con);
		}

		return $this->singleNovedadArchivo;
	}

	/**
	 * Sets a single NovedadArchivo object as related to this object by a one-to-one relationship.
	 *
	 * @param      NovedadArchivo $v NovedadArchivo
	 * @return     Archivo The current object (for fluent API support)
	 * @throws     PropelException
	 */
	public function setNovedadArchivo(NovedadArchivo $v = null)
	{
		$this->singleNovedadArchivo = $v;

		// Make sure that that the passed-in NovedadArchivo isn't already associated with this object
		if ($v !== null && $v->getArchivo() === null) {
			$v->setArchivo($this);
		}

		return $this;
	}

	/**
	 * Clears the current object and sets all attributes to their default values
	 */
	public function clear()
	{
		$this->id = null;
		$this->nombreoriginal = null;
		$this->nombrereferencia = null;
		$this->mime = null;
		$this->size = null;
		$this->alreadyInSave = false;
		$this->alreadyInValidation = false;
		$this->clearAllReferences();
		$this->resetModified();
		$this->setNew(true);
		$this->setDeleted(false);
	}

	/**
	 * Resets all references to other model objects or collections of model objects.
	 *
	 * This method is a user-space workaround for PHP's inability to garbage collect
	 * objects with circular references (even in PHP 5.3). This is currently necessary
	 * when using Propel in certain daemon or large-volumne/high-memory operations.
	 *
	 * @param      boolean $deep Whether to also clear the references on all referrer objects.
	 */
	public function clearAllReferences($deep = false)
	{
		if ($deep) {
			if ($this->singleNovedadImagenChica) {
				$this->singleNovedadImagenChica->clearAllReferences($deep);
			}
			if ($this->singleNovedadImagenGrande) {
				$this->singleNovedadImagenGrande->clearAllReferences($deep);
			}
			if ($this->singleNovedadArchivo) {
				$this->singleNovedadArchivo->clearAllReferences($deep);
			}
		} // if ($deep)

		if ($this->singleNovedadImagenChica instanceof PropelCollection) {
			$this->singleNovedadImagenChica->clearIterator();
		}
		$this->singleNovedadImagenChica = null;
		if ($this->singleNovedadImagenGrande instanceof PropelCollection) {
			$this->singleNovedadImagenGrande->clearIterator();
		}
		$this->singleNovedadImagenGrande = null;
		if ($this->singleNovedadArchivo instanceof PropelCollection) {
			$this->singleNovedadArchivo->clearIterator();
		}
		$this->singleNovedadArchivo = null;
	}

	/**
	 * Return the string representation of this object
	 *
	 * @return string
	 */
	public function __toString()
	{
		return (string) $this->exportTo(ArchivoPeer::DEFAULT_STRING_FORMAT);
	}

} // BaseArchivo
