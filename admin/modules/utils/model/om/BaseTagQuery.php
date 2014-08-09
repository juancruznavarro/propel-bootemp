<?php


/**
 * Base class that represents a query for the 'Tag' table.
 *
 *
 *
 * @method     TagQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     TagQuery orderByNombre($order = Criteria::ASC) Order by the nombre column
 *
 * @method     TagQuery groupById() Group by the id column
 * @method     TagQuery groupByNombre() Group by the nombre column
 *
 * @method     TagQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     TagQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     TagQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     TagQuery leftJoinNovedadTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the NovedadTag relation
 * @method     TagQuery rightJoinNovedadTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the NovedadTag relation
 * @method     TagQuery innerJoinNovedadTag($relationAlias = null) Adds a INNER JOIN clause to the query using the NovedadTag relation
 *
 * @method     Tag findOne(PropelPDO $con = null) Return the first Tag matching the query
 * @method     Tag findOneOrCreate(PropelPDO $con = null) Return the first Tag matching the query, or a new Tag object populated from the query conditions when no match is found
 *
 * @method     Tag findOneById(int $id) Return the first Tag filtered by the id column
 * @method     Tag findOneByNombre(string $nombre) Return the first Tag filtered by the nombre column
 *
 * @method     array findById(int $id) Return Tag objects filtered by the id column
 * @method     array findByNombre(string $nombre) Return Tag objects filtered by the nombre column
 *
 * @package    propel.generator.utils.model.om
 */
abstract class BaseTagQuery extends ModelCriteria
{

	/**
	 * Initializes internal state of BaseTagQuery object.
	 *
	 * @param     string $dbName The dabase name
	 * @param     string $modelName The phpName of a model, e.g. 'Book'
	 * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
	 */
	public function __construct($dbName = 'db_instalador', $modelName = 'Tag', $modelAlias = null)
	{
		parent::__construct($dbName, $modelName, $modelAlias);
	}

	/**
	 * Returns a new TagQuery object.
	 *
	 * @param     string $modelAlias The alias of a model in the query
	 * @param     Criteria $criteria Optional Criteria to build the query from
	 *
	 * @return    TagQuery
	 */
	public static function create($modelAlias = null, $criteria = null)
	{
		if ($criteria instanceof TagQuery) {
			return $criteria;
		}
		$query = new TagQuery();
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
	 * @return    Tag|array|mixed the result, formatted by the current formatter
	 */
	public function findPk($key, $con = null)
	{
		if ($key === null) {
			return null;
		}
		if ((null !== ($obj = TagPeer::getInstanceFromPool((string) $key))) && !$this->formatter) {
			// the object is alredy in the instance pool
			return $obj;
		}
		if ($con === null) {
			$con = Propel::getConnection(TagPeer::DATABASE_NAME, Propel::CONNECTION_READ);
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
	 * @return    Tag A model object, or null if the key is not found
	 */
	protected function findPkSimple($key, $con)
	{
		$sql = 'SELECT `ID`, `NOMBRE` FROM `Tag` WHERE `ID` = :p0';
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
			$obj = new Tag();
			$obj->hydrate($row);
			TagPeer::addInstanceToPool($obj, (string) $key);
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
	 * @return    Tag|array|mixed the result, formatted by the current formatter
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
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKey($key)
	{
		return $this->addUsingAlias(TagPeer::ID, $key, Criteria::EQUAL);
	}

	/**
	 * Filter the query by a list of primary keys
	 *
	 * @param     array $keys The list of primary key to use for the query
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterByPrimaryKeys($keys)
	{
		return $this->addUsingAlias(TagPeer::ID, $keys, Criteria::IN);
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
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterById($id = null, $comparison = null)
	{
		if (is_array($id) && null === $comparison) {
			$comparison = Criteria::IN;
		}
		return $this->addUsingAlias(TagPeer::ID, $id, $comparison);
	}

	/**
	 * Filter the query on the nombre column
	 *
	 * Example usage:
	 * <code>
	 * $query->filterByNombre('fooValue');   // WHERE nombre = 'fooValue'
	 * $query->filterByNombre('%fooValue%'); // WHERE nombre LIKE '%fooValue%'
	 * </code>
	 *
	 * @param     string $nombre The value to use as filter.
	 *              Accepts wildcards (* and % trigger a LIKE)
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterByNombre($nombre = null, $comparison = null)
	{
		if (null === $comparison) {
			if (is_array($nombre)) {
				$comparison = Criteria::IN;
			} elseif (preg_match('/[\%\*]/', $nombre)) {
				$nombre = str_replace('*', '%', $nombre);
				$comparison = Criteria::LIKE;
			}
		}
		return $this->addUsingAlias(TagPeer::NOMBRE, $nombre, $comparison);
	}

	/**
	 * Filter the query by a related NovedadTag object
	 *
	 * @param     NovedadTag $novedadTag  the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterByNovedadTag($novedadTag, $comparison = null)
	{
		if ($novedadTag instanceof NovedadTag) {
			return $this
			->addUsingAlias(TagPeer::ID, $novedadTag->getIdTag(), $comparison);
		} elseif ($novedadTag instanceof PropelCollection) {
			return $this
			->useNovedadTagQuery()
			->filterByPrimaryKeys($novedadTag->getPrimaryKeys())
			->endUse();
		} else {
			throw new PropelException('filterByNovedadTag() only accepts arguments of type NovedadTag or PropelCollection');
		}
	}

	/**
	 * Adds a JOIN clause to the query using the NovedadTag relation
	 *
	 * @param     string $relationAlias optional alias for the relation
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function joinNovedadTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		$tableMap = $this->getTableMap();
		$relationMap = $tableMap->getRelation('NovedadTag');

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
			$this->addJoinObject($join, 'NovedadTag');
		}

		return $this;
	}

	/**
	 * Use the NovedadTag relation NovedadTag object
	 *
	 * @see       useQuery()
	 *
	 * @param     string $relationAlias optional alias for the relation,
	 *                                   to be used as main alias in the secondary query
	 * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
	 *
	 * @return    NovedadTagQuery A secondary query class using the current class as primary query
	 */
	public function useNovedadTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
	{
		return $this
		->joinNovedadTag($relationAlias, $joinType)
		->useQuery($relationAlias ? $relationAlias : 'NovedadTag', 'NovedadTagQuery');
	}

	/**
	 * Filter the query by a related Novedad object
	 * using the NovedadTag table as cross reference
	 *
	 * @param     Novedad $novedad the related object to use as filter
	 * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function filterByNovedad($novedad, $comparison = Criteria::EQUAL)
	{
		return $this
		->useNovedadTagQuery()
		->filterByNovedad($novedad, $comparison)
		->endUse();
	}

	/**
	 * Exclude object from result
	 *
	 * @param     Tag $tag Object to remove from the list of results
	 *
	 * @return    TagQuery The current query, for fluid interface
	 */
	public function prune($tag = null)
	{
		if ($tag) {
			$this->addUsingAlias(TagPeer::ID, $tag->getId(), Criteria::NOT_EQUAL);
		}

		return $this;
	}

} // BaseTagQuery