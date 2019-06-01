<?php

namespace Base;

use \Bookinreadinglist as ChildBookinreadinglist;
use \BookinreadinglistQuery as ChildBookinreadinglistQuery;
use \Exception;
use \PDO;
use Map\BookinreadinglistTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'bookinreadinglist' table.
 *
 *
 *
 * @method     ChildBookinreadinglistQuery orderByReadinglistRlid($order = Criteria::ASC) Order by the readingList_RLID column
 * @method     ChildBookinreadinglistQuery orderByBookBookid($order = Criteria::ASC) Order by the book_bookID column
 *
 * @method     ChildBookinreadinglistQuery groupByReadinglistRlid() Group by the readingList_RLID column
 * @method     ChildBookinreadinglistQuery groupByBookBookid() Group by the book_bookID column
 *
 * @method     ChildBookinreadinglistQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookinreadinglistQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookinreadinglistQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookinreadinglistQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookinreadinglistQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookinreadinglistQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookinreadinglistQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ChildBookinreadinglistQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ChildBookinreadinglistQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ChildBookinreadinglistQuery joinWithBook($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Book relation
 *
 * @method     ChildBookinreadinglistQuery leftJoinWithBook() Adds a LEFT JOIN clause and with to the query using the Book relation
 * @method     ChildBookinreadinglistQuery rightJoinWithBook() Adds a RIGHT JOIN clause and with to the query using the Book relation
 * @method     ChildBookinreadinglistQuery innerJoinWithBook() Adds a INNER JOIN clause and with to the query using the Book relation
 *
 * @method     ChildBookinreadinglistQuery leftJoinReadinglist($relationAlias = null) Adds a LEFT JOIN clause to the query using the Readinglist relation
 * @method     ChildBookinreadinglistQuery rightJoinReadinglist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Readinglist relation
 * @method     ChildBookinreadinglistQuery innerJoinReadinglist($relationAlias = null) Adds a INNER JOIN clause to the query using the Readinglist relation
 *
 * @method     ChildBookinreadinglistQuery joinWithReadinglist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Readinglist relation
 *
 * @method     ChildBookinreadinglistQuery leftJoinWithReadinglist() Adds a LEFT JOIN clause and with to the query using the Readinglist relation
 * @method     ChildBookinreadinglistQuery rightJoinWithReadinglist() Adds a RIGHT JOIN clause and with to the query using the Readinglist relation
 * @method     ChildBookinreadinglistQuery innerJoinWithReadinglist() Adds a INNER JOIN clause and with to the query using the Readinglist relation
 *
 * @method     \BookQuery|\ReadinglistQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBookinreadinglist findOne(ConnectionInterface $con = null) Return the first ChildBookinreadinglist matching the query
 * @method     ChildBookinreadinglist findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBookinreadinglist matching the query, or a new ChildBookinreadinglist object populated from the query conditions when no match is found
 *
 * @method     ChildBookinreadinglist findOneByReadinglistRlid(int $readingList_RLID) Return the first ChildBookinreadinglist filtered by the readingList_RLID column
 * @method     ChildBookinreadinglist findOneByBookBookid(int $book_bookID) Return the first ChildBookinreadinglist filtered by the book_bookID column *

 * @method     ChildBookinreadinglist requirePk($key, ConnectionInterface $con = null) Return the ChildBookinreadinglist by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookinreadinglist requireOne(ConnectionInterface $con = null) Return the first ChildBookinreadinglist matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookinreadinglist requireOneByReadinglistRlid(int $readingList_RLID) Return the first ChildBookinreadinglist filtered by the readingList_RLID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBookinreadinglist requireOneByBookBookid(int $book_bookID) Return the first ChildBookinreadinglist filtered by the book_bookID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBookinreadinglist[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBookinreadinglist objects based on current ModelCriteria
 * @method     ChildBookinreadinglist[]|ObjectCollection findByReadinglistRlid(int $readingList_RLID) Return ChildBookinreadinglist objects filtered by the readingList_RLID column
 * @method     ChildBookinreadinglist[]|ObjectCollection findByBookBookid(int $book_bookID) Return ChildBookinreadinglist objects filtered by the book_bookID column
 * @method     ChildBookinreadinglist[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookinreadinglistQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BookinreadinglistQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Bookinreadinglist', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookinreadinglistQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookinreadinglistQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookinreadinglistQuery) {
            return $criteria;
        }
        $query = new ChildBookinreadinglistQuery();
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
     * $obj = $c->findPk(array(12, 34), $con);
     * </code>
     *
     * @param array[$readingList_RLID, $book_bookID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBookinreadinglist|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookinreadinglistTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookinreadinglistTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBookinreadinglist A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT readingList_RLID, book_bookID FROM bookinreadinglist WHERE readingList_RLID = :p0 AND book_bookID = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBookinreadinglist $obj */
            $obj = new ChildBookinreadinglist();
            $obj->hydrate($row);
            BookinreadinglistTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBookinreadinglist|array|mixed the result, formatted by the current formatter
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
     * $objs = $c->findPks(array(array(12, 56), array(832, 123), array(123, 456)), $con);
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
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BookinreadinglistTableMap::COL_READINGLIST_RLID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BookinreadinglistTableMap::COL_BOOK_BOOKID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the readingList_RLID column
     *
     * Example usage:
     * <code>
     * $query->filterByReadinglistRlid(1234); // WHERE readingList_RLID = 1234
     * $query->filterByReadinglistRlid(array(12, 34)); // WHERE readingList_RLID IN (12, 34)
     * $query->filterByReadinglistRlid(array('min' => 12)); // WHERE readingList_RLID > 12
     * </code>
     *
     * @see       filterByReadinglist()
     *
     * @param     mixed $readinglistRlid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByReadinglistRlid($readinglistRlid = null, $comparison = null)
    {
        if (is_array($readinglistRlid)) {
            $useMinMax = false;
            if (isset($readinglistRlid['min'])) {
                $this->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $readinglistRlid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($readinglistRlid['max'])) {
                $this->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $readinglistRlid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $readinglistRlid, $comparison);
    }

    /**
     * Filter the query on the book_bookID column
     *
     * Example usage:
     * <code>
     * $query->filterByBookBookid(1234); // WHERE book_bookID = 1234
     * $query->filterByBookBookid(array(12, 34)); // WHERE book_bookID IN (12, 34)
     * $query->filterByBookBookid(array('min' => 12)); // WHERE book_bookID > 12
     * </code>
     *
     * @see       filterByBook()
     *
     * @param     mixed $bookBookid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByBookBookid($bookBookid = null, $comparison = null)
    {
        if (is_array($bookBookid)) {
            $useMinMax = false;
            if (isset($bookBookid['min'])) {
                $this->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $bookBookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookBookid['max'])) {
                $this->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $bookBookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $bookBookid, $comparison);
    }

    /**
     * Filter the query by a related \Book object
     *
     * @param \Book|ObjectCollection $book The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByBook($book, $comparison = null)
    {
        if ($book instanceof \Book) {
            return $this
                ->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $book->getBookid(), $comparison);
        } elseif ($book instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookinreadinglistTableMap::COL_BOOK_BOOKID, $book->toKeyValue('PrimaryKey', 'Bookid'), $comparison);
        } else {
            throw new PropelException('filterByBook() only accepts arguments of type \Book or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Book relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function joinBook($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Book');

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
            $this->addJoinObject($join, 'Book');
        }

        return $this;
    }

    /**
     * Use the Book relation Book object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BookQuery A secondary query class using the current class as primary query
     */
    public function useBookQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBook($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Book', '\BookQuery');
    }

    /**
     * Filter the query by a related \Readinglist object
     *
     * @param \Readinglist|ObjectCollection $readinglist The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function filterByReadinglist($readinglist, $comparison = null)
    {
        if ($readinglist instanceof \Readinglist) {
            return $this
                ->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $readinglist->getRlid(), $comparison);
        } elseif ($readinglist instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookinreadinglistTableMap::COL_READINGLIST_RLID, $readinglist->toKeyValue('PrimaryKey', 'Rlid'), $comparison);
        } else {
            throw new PropelException('filterByReadinglist() only accepts arguments of type \Readinglist or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Readinglist relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function joinReadinglist($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Readinglist');

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
            $this->addJoinObject($join, 'Readinglist');
        }

        return $this;
    }

    /**
     * Use the Readinglist relation Readinglist object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ReadinglistQuery A secondary query class using the current class as primary query
     */
    public function useReadinglistQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinReadinglist($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Readinglist', '\ReadinglistQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBookinreadinglist $bookinreadinglist Object to remove from the list of results
     *
     * @return $this|ChildBookinreadinglistQuery The current query, for fluid interface
     */
    public function prune($bookinreadinglist = null)
    {
        if ($bookinreadinglist) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BookinreadinglistTableMap::COL_READINGLIST_RLID), $bookinreadinglist->getReadinglistRlid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BookinreadinglistTableMap::COL_BOOK_BOOKID), $bookinreadinglist->getBookBookid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the bookinreadinglist table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookinreadinglistTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookinreadinglistTableMap::clearInstancePool();
            BookinreadinglistTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookinreadinglistTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookinreadinglistTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookinreadinglistTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookinreadinglistTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookinreadinglistQuery
