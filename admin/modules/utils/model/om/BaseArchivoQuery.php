<?php


/**
 * Base class that represents a query for the 'Archivo' table.
 *
 *
 *
 * @method     ArchivoQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ArchivoQuery orderByNombreOriginal($order = Criteria::ASC) Order by the nombreOriginal column
 * @method     ArchivoQuery orderByNombreReferencia($order = Criteria::ASC) Order by the nombreReferencia column
 * @method     ArchivoQuery orderByMime($order = Criteria::ASC) Order by the mime column
 * @method     ArchivoQuery orderBySize($order = Criteria::ASC) Order by the size column
 *
 * @method     ArchivoQuery groupById() Group by the id column
 * @method     ArchivoQuery groupByNombreOriginal() Group by the nombreOriginal column
 * @method     ArchivoQuery groupByNombreReferencia() Group by the nombreReferencia column
 * @method     ArchivoQuery groupByMime() Group by the mime column
 * @method     ArchivoQuery groupBySize() Group by the size column
 *
 * @method     ArchivoQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ArchivoQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ArchivoQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ArchivoQuery leftJoinNovedadImagenChica($relationAlias = null) Adds a LEFT JOIN clause to the query using the NovedadImagenChica relation
 * @method     ArchivoQuery rightJoinNovedadImagenChica($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NovedadImagenChica relation
 * @method     ArchivoQuery innerJoinNovedadImagenChica($relationAlias = null) Adds a INNER JOIN clause to the query using the NovedadImagenChica relation
 *
 * @method     ArchivoQuery leftJoinNovedadImagenGrande($relationAlias = null) Adds a LEFT JOIN clause to the query using the NovedadImagenGrande relation
 * @method     ArchivoQuery rightJoinNovedadImagenGrande($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NovedadImagenGrande relation
 * @method     ArchivoQuery innerJoinNovedadImagenGrande($relationAlias = null) Adds a INNER JOIN clause to the query using the NovedadImagenGrande relation
 *
 * @method     ArchivoQuery leftJoinNovedadArchivo($relationAlias = null) Adds a LEFT JOIN clause to the query using the NovedadArchivo relation
 * @method     ArchivoQuery rightJoinNovedadArchivo($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NovedadArchivo relation
 * @method     ArchivoQuery innerJoinNovedadArchivo($relationAlias = null) Adds a INNER JOIN clause to the query using the NovedadArchivo relation
 *
 * @method     Archivo findOne(PropelPDO $con = null) Return the first Archivo matching the query
 * @method     Archivo findOneOrCreate(PropelPDO $con = null) Return the first Archivo matching the query, or a new Archivo object populated from the query conditions when no match is found
 *
 * @method     Archivo findOneById(int $id) Return the first Archivo filtered by the id column
 * @method     Archivo findOneByNombreOriginal(string $nombreOriginal) Return the first Archivo filtered by the nombreOriginal column
 * @method     Archivo findOneByNombreReferencia(string $nombreReferencia) Return the first Archivo filtered by the nombreReferencia column
 * @method     Archivo findOneByMime(string $mime) Return the first Archivo filtered by the mime column
 * @method     Archivo findOneBySize(string $size) Return the first Archivo filtered by the size column
 *
 * @method     array findById(int $id) Return Archivo objects filtered by the id column
 * @method     array findByNombreOriginal(string $nombreOriginal) Return Archivo objects filtered by the nombreOriginal column
 * @method     array findByNombreReferencia(string $nombreReferencia) Return Archivo objects filtered by the nombreReferencia column
 * @method     array findByMime(string $mime) Return Archivo objects filtered by the mime column
 * @method     array findBySize(string $size) Return Archivo objects filtered by the size column
 *
 * @package    propel.generator.utils.model.om
 */
abstract class BaseArchivoQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseArchivoQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'db_instalador', $modelName = 'Archivo', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new ArchivoQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    ArchivoQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof ArchivoQuery) {
			return $criteria;
		}
		$query = new ArchivoQuery();
		if (null !== $modelAlias) {
			$query->setModelAlias($modelAlias);
		}
		if ($criteria instanceof Criteria) {
			$query->mergeWith($criteria);
		}
		return $query;
	}

	/**
	 * Find object by primary key.
	 * Propel uses the instance pool to skip the database if the object exists.
	 * Go fast if the query is untouched.
	 *
	 * <code>
	 * $obj  = $c->findPk(12, $con);
	 * </code>
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    Archivo|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = ArchivoPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(ArchivoPeer::DATABASE_NAME, Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		if ($this->formatter || $this->modelAlias || $this->with || $this->select
		|| $this->selectColumns || $this->asColumns || $this->selectModifiers
		|| $this->map || $this->having || $this->joins) {
			return $this->findPkComplex($key, $con);
		} else {
			return $this->findPkSimple($key, $con);
		}
	}

	/**
	 * Find object by primary key using raw SQL to go fast.
	 * Bypass doSelect() and the object formatter by using generated code.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Archivo A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NOMBREORIGINAL`, `NOMBREREFERENCIA`, `MIME`, `SIZE` FROM `Archivo` WHERE `ID` = :p0';
		try {
			$stmt = $con->prepare($sql);
			$stmt->bindValue(':p0', $key, PDO::PARAM_INT);
			$stmt->execute();
		} catch (Exception $e) {
			Propel::log($e->getMessage(), Propel::LOG_ERR);
			throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), $e);
		}
		$obj = null;
		if ($row = $stmt->fetch(PDO::FETCH_NUM)) {
			$obj = new Archivo();
			$obj->hydrate($row);
			ArchivoPeer::addInstanceToPool($obj, (string) $key);
		}
		$stmt->closeCursor();

		return $obj;
	}

	/**
	 * Find object by primary key.
	 *
	 * @param     mixed $key Primary key to use for the query
	 * @param     PropelPDO $con A connection object
	 *
	 * @return    Archivo|array|mixed the result, formatted by the current formatter
	 */
	protected function findPkComplex($key, $con)
	{
		// As the query uses a PK condition, no limit(1) is necessary.
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
		->filterByPrimaryKey($key)
		->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->formatOne($stmt);
	}

	/**
	 * Find objects by primary key
	 * <code>
	 * $objs = $c->findPks(array(12, 56, 832), $con);
	 * </code>
	 * @param     array $keys Primary keys to use for the query
	 * @param     PropelPDO $con an optional connection object
	 *
	 * @return    PropelObjectCollection|array|mixed the list of results, formatted by the current formatter
	 */
	public function findPks($keys, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection($this->getDbName(), Propel::CONNECTION_READ);
		}
		$this->basePreSelect($con);
		$criteria = $this->isKeepQuery() ? clone $this : $this;
		$stmt = $criteria
		->filterByPrimaryKeys($keys)
		->doSelect($con);
		return $criteria->getFormatter()->init($criteria)->format($stmt);
	}

	/**
	 * Filter the query by primary key
	 *
	 * @param     mixed $key Primary key to use for the query
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(ArchivoPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(ArchivoPeer::ID, $keys, Criteria::IN);
	}

	/**
	 * Filter the query on the id column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterById(1234); // WHERE id = 1234
	 * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
	 * $query->filterById(array('min' => 12)); // WHERE id > 12
	 * </code>
	 *
	 * @param     mixed $id The value to use as filter.
	 *              Use scalar values for equality.
	 *              Use array values for in_array() equivalent.
	 *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(ArchivoPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the nombreOriginal column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNombreOriginal('fooValue');   // WHERE nombreOriginal = 'fooValue'
	 * $query->filterByNombreOriginal('%fooValue%'); // WHERE nombreOriginal LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $nombreOriginal The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByNombreOriginal($nombreOriginal = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nombreOriginal)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nombreOriginal)) {
				$nombreOriginal = str_replace('*', '%', $nombreOriginal);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchivoPeer::NOMBREORIGINAL, $nombreOriginal, $comparison);
	}

	/**
	 * Filter the query on the nombreReferencia column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNombreReferencia('fooValue');   // WHERE nombreReferencia = 'fooValue'
	 * $query->filterByNombreReferencia('%fooValue%'); // WHERE nombreReferencia LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $nombreReferencia The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByNombreReferencia($nombreReferencia = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nombreReferencia)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nombreReferencia)) {
				$nombreReferencia = str_replace('*', '%', $nombreReferencia);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchivoPeer::NOMBREREFERENCIA, $nombreReferencia, $comparison);
	}

	/**
	 * Filter the query on the mime column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByMime('fooValue');   // WHERE mime = 'fooValue'
	 * $query->filterByMime('%fooValue%'); // WHERE mime LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $mime The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByMime($mime = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($mime)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $mime)) {
				$mime = str_replace('*', '%', $mime);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchivoPeer::MIME, $mime, $comparison);
	}

	/**
	 * Filter the query on the size column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterBySize('fooValue');   // WHERE size = 'fooValue'
	 * $query->filterBySize('%fooValue%'); // WHERE size LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $size The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterBySize($size = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($size)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $size)) {
				$size = str_replace('*', '%', $size);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(ArchivoPeer::SIZE, $size, $comparison);
	}

	/**
	 * Filter the query by a related NovedadImagenChica object
	 *
	 * @param     NovedadImagenChica $novedadImagenChica  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByNovedadImagenChica($novedadImagenChica, $comparison = null)
	{
		if ($novedadImagenChica instanceof NovedadImagenChica) {
			return $this
			->addUsingAlias(ArchivoPeer::ID, $novedadImagenChica->getId(), $comparison);
		} elseif ($novedadImagenChica instanceof PropelCollection) {
			return $this
			->useNovedadImagenChicaQuery()
			->filterByPrimaryKeys($novedadImagenChica->getPrimaryKeys())
			->endUse();
		} else {
			throw new PropelException('filterByNovedadImagenChica() only accepts arguments of type NovedadImagenChica or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NovedadImagenChica relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function joinNovedadImagenChica($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NovedadImagenChica');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'NovedadImagenChica');
		}

		return $this;
	}

	/**
	 * Use the NovedadImagenChica relation NovedadImagenChica object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NovedadImagenChicaQuery A secondary query class using the current class as primary query
	 */
	public function useNovedadImagenChicaQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
		->joinNovedadImagenChica($relationAlias, $joinType)
		->useQuery($relationAlias ? $relationAlias : 'NovedadImagenChica', 'NovedadImagenChicaQuery');
	}

	/**
	 * Filter the query by a related NovedadImagenGrande object
	 *
	 * @param     NovedadImagenGrande $novedadImagenGrande  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByNovedadImagenGrande($novedadImagenGrande, $comparison = null)
	{
		if ($novedadImagenGrande instanceof NovedadImagenGrande) {
			return $this
			->addUsingAlias(ArchivoPeer::ID, $novedadImagenGrande->getId(), $comparison);
		} elseif ($novedadImagenGrande instanceof PropelCollection) {
			return $this
			->useNovedadImagenGrandeQuery()
			->filterByPrimaryKeys($novedadImagenGrande->getPrimaryKeys())
			->endUse();
		} else {
			throw new PropelException('filterByNovedadImagenGrande() only accepts arguments of type NovedadImagenGrande or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NovedadImagenGrande relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function joinNovedadImagenGrande($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NovedadImagenGrande');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'NovedadImagenGrande');
		}

		return $this;
	}

	/**
	 * Use the NovedadImagenGrande relation NovedadImagenGrande object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NovedadImagenGrandeQuery A secondary query class using the current class as primary query
	 */
	public function useNovedadImagenGrandeQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
		->joinNovedadImagenGrande($relationAlias, $joinType)
		->useQuery($relationAlias ? $relationAlias : 'NovedadImagenGrande', 'NovedadImagenGrandeQuery');
	}

	/**
	 * Filter the query by a related NovedadArchivo object
	 *
	 * @param     NovedadArchivo $novedadArchivo  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function filterByNovedadArchivo($novedadArchivo, $comparison = null)
	{
		if ($novedadArchivo instanceof NovedadArchivo) {
			return $this
			->addUsingAlias(ArchivoPeer::ID, $novedadArchivo->getId(), $comparison);
		} elseif ($novedadArchivo instanceof PropelCollection) {
			return $this
			->useNovedadArchivoQuery()
			->filterByPrimaryKeys($novedadArchivo->getPrimaryKeys())
			->endUse();
		} else {
			throw new PropelException('filterByNovedadArchivo() only accepts arguments of type NovedadArchivo or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NovedadArchivo relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function joinNovedadArchivo($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NovedadArchivo');

		// create a ModelJoin object for this join
		$join = new ModelJoin();
		$join->setJoinType($joinType);
		$join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
		if ($previousJoin = $this->getPreviousJoin()) {
			$join->setPreviousJoin($previousJoin);
		}

		// add the ModelJoin to the current object
		if($relationAlias) {
			$this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
			$this->addJoinObject($join, $relationAlias);
		} else {
			$this->addJoinObject($join, 'NovedadArchivo');
		}

		return $this;
	}

	/**
	 * Use the NovedadArchivo relation NovedadArchivo object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NovedadArchivoQuery A secondary query class using the current class as primary query
	 */
	public function useNovedadArchivoQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
		->joinNovedadArchivo($relationAlias, $joinType)
		->useQuery($relationAlias ? $relationAlias : 'NovedadArchivo', 'NovedadArchivoQuery');
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Archivo $archivo Object to remove from the list of results
	 *
	 * @return    ArchivoQuery The current query, for fluid interface
	 */
	public function prune($archivo = null)
	{
		if ($archivo) {
			$this->addUsingAlias(ArchivoPeer::ID, $archivo->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseArchivoQuery