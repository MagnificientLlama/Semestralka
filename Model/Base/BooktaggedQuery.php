<?php

namespace Base;

use \Booktagged as ChildBooktagged;
use \BooktaggedQuery as ChildBooktaggedQuery;
use \Exception;
use \PDO;
use Map\BooktaggedTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'booktagged' table.
 *
 *
 *
 * @method     ChildBooktaggedQuery orderByTagTagname($order = Criteria::ASC) Order by the tag_tagName column
 * @method     ChildBooktaggedQuery orderByBookBookid($order = Criteria::ASC) Order by the book_bookID column
 *
 * @method     ChildBooktaggedQuery groupByTagTagname() Group by the tag_tagName column
 * @method     ChildBooktaggedQuery groupByBookBookid() Group by the book_bookID column
 *
 * @method     ChildBooktaggedQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBooktaggedQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBooktaggedQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBooktaggedQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBooktaggedQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBooktaggedQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBooktaggedQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ChildBooktaggedQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ChildBooktaggedQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ChildBooktaggedQuery joinWithBook($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Book relation
 *
 * @method     ChildBooktaggedQuery leftJoinWithBook() Adds a LEFT JOIN clause and with to the query using the Book relation
 * @method     ChildBooktaggedQuery rightJoinWithBook() Adds a RIGHT JOIN clause and with to the query using the Book relation
 * @method     ChildBooktaggedQuery innerJoinWithBook() Adds a INNER JOIN clause and with to the query using the Book relation
 *
 * @method     ChildBooktaggedQuery leftJoinTag($relationAlias = null) Adds a LEFT JOIN clause to the query using the Tag relation
 * @method     ChildBooktaggedQuery rightJoinTag($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Tag relation
 * @method     ChildBooktaggedQuery innerJoinTag($relationAlias = null) Adds a INNER JOIN clause to the query using the Tag relation
 *
 * @method     ChildBooktaggedQuery joinWithTag($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Tag relation
 *
 * @method     ChildBooktaggedQuery leftJoinWithTag() Adds a LEFT JOIN clause and with to the query using the Tag relation
 * @method     ChildBooktaggedQuery rightJoinWithTag() Adds a RIGHT JOIN clause and with to the query using the Tag relation
 * @method     ChildBooktaggedQuery innerJoinWithTag() Adds a INNER JOIN clause and with to the query using the Tag relation
 *
 * @method     \BookQuery|\TagQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBooktagged findOne(ConnectionInterface $con = null) Return the first ChildBooktagged matching the query
 * @method     ChildBooktagged findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBooktagged matching the query, or a new ChildBooktagged object populated from the query conditions when no match is found
 *
 * @method     ChildBooktagged findOneByTagTagname(string $tag_tagName) Return the first ChildBooktagged filtered by the tag_tagName column
 * @method     ChildBooktagged findOneByBookBookid(int $book_bookID) Return the first ChildBooktagged filtered by the book_bookID column *

 * @method     ChildBooktagged requirePk($key, ConnectionInterface $con = null) Return the ChildBooktagged by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooktagged requireOne(ConnectionInterface $con = null) Return the first ChildBooktagged matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooktagged requireOneByTagTagname(string $tag_tagName) Return the first ChildBooktagged filtered by the tag_tagName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBooktagged requireOneByBookBookid(int $book_bookID) Return the first ChildBooktagged filtered by the book_bookID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBooktagged[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBooktagged objects based on current ModelCriteria
 * @method     ChildBooktagged[]|ObjectCollection findByTagTagname(string $tag_tagName) Return ChildBooktagged objects filtered by the tag_tagName column
 * @method     ChildBooktagged[]|ObjectCollection findByBookBookid(int $book_bookID) Return ChildBooktagged objects filtered by the book_bookID column
 * @method     ChildBooktagged[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BooktaggedQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BooktaggedQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Booktagged', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBooktaggedQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBooktaggedQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBooktaggedQuery) {
            return $criteria;
        }
        $query = new ChildBooktaggedQuery();
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
     * @param array[$tag_tagName, $book_bookID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildBooktagged|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BooktaggedTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BooktaggedTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]))))) {
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
     * @return ChildBooktagged A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT tag_tagName, book_bookID FROM booktagged WHERE tag_tagName = :p0 AND book_bookID = :p1';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_STR);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildBooktagged $obj */
            $obj = new ChildBooktagged();
            $obj->hydrate($row);
            BooktaggedTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1])]));
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
     * @return ChildBooktagged|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(BooktaggedTableMap::COL_TAG_TAGNAME, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $key[1], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(BooktaggedTableMap::COL_TAG_TAGNAME, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(BooktaggedTableMap::COL_BOOK_BOOKID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the tag_tagName column
     *
     * Example usage:
     * <code>
     * $query->filterByTagTagname('fooValue');   // WHERE tag_tagName = 'fooValue'
     * $query->filterByTagTagname('%fooValue%', Criteria::LIKE); // WHERE tag_tagName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $tagTagname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByTagTagname($tagTagname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($tagTagname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooktaggedTableMap::COL_TAG_TAGNAME, $tagTagname, $comparison);
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
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByBookBookid($bookBookid = null, $comparison = null)
    {
        if (is_array($bookBookid)) {
            $useMinMax = false;
            if (isset($bookBookid['min'])) {
                $this->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $bookBookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookBookid['max'])) {
                $this->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $bookBookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $bookBookid, $comparison);
    }

    /**
     * Filter the query by a related \Book object
     *
     * @param \Book|ObjectCollection $book The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByBook($book, $comparison = null)
    {
        if ($book instanceof \Book) {
            return $this
                ->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $book->getBookid(), $comparison);
        } elseif ($book instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooktaggedTableMap::COL_BOOK_BOOKID, $book->toKeyValue('PrimaryKey', 'Bookid'), $comparison);
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
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
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
     * Filter the query by a related \Tag object
     *
     * @param \Tag|ObjectCollection $tag The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBooktaggedQuery The current query, for fluid interface
     */
    public function filterByTag($tag, $comparison = null)
    {
        if ($tag instanceof \Tag) {
            return $this
                ->addUsingAlias(BooktaggedTableMap::COL_TAG_TAGNAME, $tag->getTagname(), $comparison);
        } elseif ($tag instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BooktaggedTableMap::COL_TAG_TAGNAME, $tag->toKeyValue('PrimaryKey', 'Tagname'), $comparison);
        } else {
            throw new PropelException('filterByTag() only accepts arguments of type \Tag or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Tag relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function joinTag($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Tag');

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
            $this->addJoinObject($join, 'Tag');
        }

        return $this;
    }

    /**
     * Use the Tag relation Tag object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \TagQuery A secondary query class using the current class as primary query
     */
    public function useTagQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinTag($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Tag', '\TagQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBooktagged $booktagged Object to remove from the list of results
     *
     * @return $this|ChildBooktaggedQuery The current query, for fluid interface
     */
    public function prune($booktagged = null)
    {
        if ($booktagged) {
            $this->addCond('pruneCond0', $this->getAliasedColName(BooktaggedTableMap::COL_TAG_TAGNAME), $booktagged->getTagTagname(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(BooktaggedTableMap::COL_BOOK_BOOKID), $booktagged->getBookBookid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the booktagged table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BooktaggedTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BooktaggedTableMap::clearInstancePool();
            BooktaggedTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BooktaggedTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BooktaggedTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BooktaggedTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BooktaggedTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BooktaggedQuery
