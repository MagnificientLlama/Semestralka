<?php

namespace Base;

use \Readinglist as ChildReadinglist;
use \ReadinglistQuery as ChildReadinglistQuery;
use \Exception;
use \PDO;
use Map\ReadinglistTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'readinglist' table.
 *
 *
 *
 * @method     ChildReadinglistQuery orderByRlid($order = Criteria::ASC) Order by the RLID column
 * @method     ChildReadinglistQuery orderByRlname($order = Criteria::ASC) Order by the RLName column
 * @method     ChildReadinglistQuery orderByUserUserid1($order = Criteria::ASC) Order by the user_userID1 column
 *
 * @method     ChildReadinglistQuery groupByRlid() Group by the RLID column
 * @method     ChildReadinglistQuery groupByRlname() Group by the RLName column
 * @method     ChildReadinglistQuery groupByUserUserid1() Group by the user_userID1 column
 *
 * @method     ChildReadinglistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildReadinglistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildReadinglistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildReadinglistQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildReadinglistQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildReadinglistQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildReadinglistQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildReadinglistQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildReadinglistQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildReadinglistQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildReadinglistQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildReadinglistQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildReadinglistQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     ChildReadinglistQuery leftJoinBookinreadinglist($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookinreadinglist relation
 * @method     ChildReadinglistQuery rightJoinBookinreadinglist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookinreadinglist relation
 * @method     ChildReadinglistQuery innerJoinBookinreadinglist($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookinreadinglist relation
 *
 * @method     ChildReadinglistQuery joinWithBookinreadinglist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookinreadinglist relation
 *
 * @method     ChildReadinglistQuery leftJoinWithBookinreadinglist() Adds a LEFT JOIN clause and with to the query using the Bookinreadinglist relation
 * @method     ChildReadinglistQuery rightJoinWithBookinreadinglist() Adds a RIGHT JOIN clause and with to the query using the Bookinreadinglist relation
 * @method     ChildReadinglistQuery innerJoinWithBookinreadinglist() Adds a INNER JOIN clause and with to the query using the Bookinreadinglist relation
 *
 * @method     \UserQuery|\BookinreadinglistQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildReadinglist findOne(ConnectionInterface $con = null) Return the first ChildReadinglist matching the query
 * @method     ChildReadinglist findOneOrCreate(ConnectionInterface $con = null) Return the first ChildReadinglist matching the query, or a new ChildReadinglist object populated from the query conditions when no match is found
 *
 * @method     ChildReadinglist findOneByRlid(int $RLID) Return the first ChildReadinglist filtered by the RLID column
 * @method     ChildReadinglist findOneByRlname(string $RLName) Return the first ChildReadinglist filtered by the RLName column
 * @method     ChildReadinglist findOneByUserUserid1(int $user_userID1) Return the first ChildReadinglist filtered by the user_userID1 column *

 * @method     ChildReadinglist requirePk($key, ConnectionInterface $con = null) Return the ChildReadinglist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReadinglist requireOne(ConnectionInterface $con = null) Return the first ChildReadinglist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReadinglist requireOneByRlid(int $RLID) Return the first ChildReadinglist filtered by the RLID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReadinglist requireOneByRlname(string $RLName) Return the first ChildReadinglist filtered by the RLName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildReadinglist requireOneByUserUserid1(int $user_userID1) Return the first ChildReadinglist filtered by the user_userID1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildReadinglist[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildReadinglist objects based on current ModelCriteria
 * @method     ChildReadinglist[]|ObjectCollection findByRlid(int $RLID) Return ChildReadinglist objects filtered by the RLID column
 * @method     ChildReadinglist[]|ObjectCollection findByRlname(string $RLName) Return ChildReadinglist objects filtered by the RLName column
 * @method     ChildReadinglist[]|ObjectCollection findByUserUserid1(int $user_userID1) Return ChildReadinglist objects filtered by the user_userID1 column
 * @method     ChildReadinglist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ReadinglistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ReadinglistQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Readinglist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildReadinglistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildReadinglistQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildReadinglistQuery) {
            return $criteria;
        }
        $query = new ChildReadinglistQuery();
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
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildReadinglist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ReadinglistTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ReadinglistTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
            // the object is already in the instance pool
            return $obj;
        }

        return $this->findPkSimple($key, $con);
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReadinglist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT RLID, RLName, user_userID1 FROM readinglist WHERE RLID = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildReadinglist $obj */
            $obj = new ChildReadinglist();
            $obj->hydrate($row);
            ReadinglistTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildReadinglist|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the RLID column
     *
     * Example usage:
     * <code>
     * $query->filterByRlid(1234); // WHERE RLID = 1234
     * $query->filterByRlid(array(12, 34)); // WHERE RLID IN (12, 34)
     * $query->filterByRlid(array('min' => 12)); // WHERE RLID > 12
     * </code>
     *
     * @param     mixed $rlid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByRlid($rlid = null, $comparison = null)
    {
        if (is_array($rlid)) {
            $useMinMax = false;
            if (isset($rlid['min'])) {
                $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $rlid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rlid['max'])) {
                $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $rlid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $rlid, $comparison);
    }

    /**
     * Filter the query on the RLName column
     *
     * Example usage:
     * <code>
     * $query->filterByRlname('fooValue');   // WHERE RLName = 'fooValue'
     * $query->filterByRlname('%fooValue%', Criteria::LIKE); // WHERE RLName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $rlname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByRlname($rlname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($rlname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReadinglistTableMap::COL_RLNAME, $rlname, $comparison);
    }

    /**
     * Filter the query on the user_userID1 column
     *
     * Example usage:
     * <code>
     * $query->filterByUserUserid1(1234); // WHERE user_userID1 = 1234
     * $query->filterByUserUserid1(array(12, 34)); // WHERE user_userID1 IN (12, 34)
     * $query->filterByUserUserid1(array('min' => 12)); // WHERE user_userID1 > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userUserid1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByUserUserid1($userUserid1 = null, $comparison = null)
    {
        if (is_array($userUserid1)) {
            $useMinMax = false;
            if (isset($userUserid1['min'])) {
                $this->addUsingAlias(ReadinglistTableMap::COL_USER_USERID1, $userUserid1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userUserid1['max'])) {
                $this->addUsingAlias(ReadinglistTableMap::COL_USER_USERID1, $userUserid1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ReadinglistTableMap::COL_USER_USERID1, $userUserid1, $comparison);
    }

    /**
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(ReadinglistTableMap::COL_USER_USERID1, $user->getUserid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ReadinglistTableMap::COL_USER_USERID1, $user->toKeyValue('PrimaryKey', 'Userid'), $comparison);
        } else {
            throw new PropelException('filterByUser() only accepts arguments of type \User or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the User relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function joinUser($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('User');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'User');
        }

        return $this;
    }

    /**
     * Use the User relation User object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserQuery A secondary query class using the current class as primary query
     */
    public function useUserQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUser($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'User', '\UserQuery');
    }

    /**
     * Filter the query by a related \Bookinreadinglist object
     *
     * @param \Bookinreadinglist|ObjectCollection $bookinreadinglist the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildReadinglistQuery The current query, for fluid interface
     */
    public function filterByBookinreadinglist($bookinreadinglist, $comparison = null)
    {
        if ($bookinreadinglist instanceof \Bookinreadinglist) {
            return $this
                ->addUsingAlias(ReadinglistTableMap::COL_RLID, $bookinreadinglist->getReadinglistRlid(), $comparison);
        } elseif ($bookinreadinglist instanceof ObjectCollection) {
            return $this
                ->useBookinreadinglistQuery()
                ->filterByPrimaryKeys($bookinreadinglist->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBookinreadinglist() only accepts arguments of type \Bookinreadinglist or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Bookinreadinglist relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function joinBookinreadinglist($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Bookinreadinglist');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Bookinreadinglist');
        }

        return $this;
    }

    /**
     * Use the Bookinreadinglist relation Bookinreadinglist object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BookinreadinglistQuery A secondary query class using the current class as primary query
     */
    public function useBookinreadinglistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBookinreadinglist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Bookinreadinglist', '\BookinreadinglistQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildReadinglist $readinglist Object to remove from the list of results
     *
     * @return $this|ChildReadinglistQuery The current query, for fluid interface
     */
    public function prune($readinglist = null)
    {
        if ($readinglist) {
            $this->addUsingAlias(ReadinglistTableMap::COL_RLID, $readinglist->getRlid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the readinglist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReadinglistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ReadinglistTableMap::clearInstancePool();
            ReadinglistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ReadinglistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ReadinglistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ReadinglistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ReadinglistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ReadinglistQuery
