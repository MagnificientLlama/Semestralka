<?php

namespace Base;

use \Chapter as ChildChapter;
use \ChapterQuery as ChildChapterQuery;
use \Exception;
use \PDO;
use Map\ChapterTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'chapter' table.
 *
 *
 *
 * @method     ChildChapterQuery orderByChapterid($order = Criteria::ASC) Order by the chapterID column
 * @method     ChildChapterQuery orderByChaptername($order = Criteria::ASC) Order by the chapterName column
 * @method     ChildChapterQuery orderByBookBookid($order = Criteria::ASC) Order by the book_bookID column
 *
 * @method     ChildChapterQuery groupByChapterid() Group by the chapterID column
 * @method     ChildChapterQuery groupByChaptername() Group by the chapterName column
 * @method     ChildChapterQuery groupByBookBookid() Group by the book_bookID column
 *
 * @method     ChildChapterQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildChapterQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildChapterQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildChapterQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildChapterQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildChapterQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildChapterQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ChildChapterQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ChildChapterQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ChildChapterQuery joinWithBook($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Book relation
 *
 * @method     ChildChapterQuery leftJoinWithBook() Adds a LEFT JOIN clause and with to the query using the Book relation
 * @method     ChildChapterQuery rightJoinWithBook() Adds a RIGHT JOIN clause and with to the query using the Book relation
 * @method     ChildChapterQuery innerJoinWithBook() Adds a INNER JOIN clause and with to the query using the Book relation
 *
 * @method     \BookQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildChapter findOne(ConnectionInterface $con = null) Return the first ChildChapter matching the query
 * @method     ChildChapter findOneOrCreate(ConnectionInterface $con = null) Return the first ChildChapter matching the query, or a new ChildChapter object populated from the query conditions when no match is found
 *
 * @method     ChildChapter findOneByChapterid(int $chapterID) Return the first ChildChapter filtered by the chapterID column
 * @method     ChildChapter findOneByChaptername(string $chapterName) Return the first ChildChapter filtered by the chapterName column
 * @method     ChildChapter findOneByBookBookid(int $book_bookID) Return the first ChildChapter filtered by the book_bookID column *

 * @method     ChildChapter requirePk($key, ConnectionInterface $con = null) Return the ChildChapter by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChapter requireOne(ConnectionInterface $con = null) Return the first ChildChapter matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChapter requireOneByChapterid(int $chapterID) Return the first ChildChapter filtered by the chapterID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChapter requireOneByChaptername(string $chapterName) Return the first ChildChapter filtered by the chapterName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildChapter requireOneByBookBookid(int $book_bookID) Return the first ChildChapter filtered by the book_bookID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildChapter[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildChapter objects based on current ModelCriteria
 * @method     ChildChapter[]|ObjectCollection findByChapterid(int $chapterID) Return ChildChapter objects filtered by the chapterID column
 * @method     ChildChapter[]|ObjectCollection findByChaptername(string $chapterName) Return ChildChapter objects filtered by the chapterName column
 * @method     ChildChapter[]|ObjectCollection findByBookBookid(int $book_bookID) Return ChildChapter objects filtered by the book_bookID column
 * @method     ChildChapter[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class ChapterQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\ChapterQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Chapter', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildChapterQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildChapterQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildChapterQuery) {
            return $criteria;
        }
        $query = new ChildChapterQuery();
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
     * @return ChildChapter|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(ChapterTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = ChapterTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildChapter A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT chapterID, chapterName, book_bookID FROM chapter WHERE chapterID = :p0';
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
            /** @var ChildChapter $obj */
            $obj = new ChildChapter();
            $obj->hydrate($row);
            ChapterTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildChapter|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the chapterID column
     *
     * Example usage:
     * <code>
     * $query->filterByChapterid(1234); // WHERE chapterID = 1234
     * $query->filterByChapterid(array(12, 34)); // WHERE chapterID IN (12, 34)
     * $query->filterByChapterid(array('min' => 12)); // WHERE chapterID > 12
     * </code>
     *
     * @param     mixed $chapterid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function filterByChapterid($chapterid = null, $comparison = null)
    {
        if (is_array($chapterid)) {
            $useMinMax = false;
            if (isset($chapterid['min'])) {
                $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $chapterid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($chapterid['max'])) {
                $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $chapterid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $chapterid, $comparison);
    }

    /**
     * Filter the query on the chapterName column
     *
     * Example usage:
     * <code>
     * $query->filterByChaptername('fooValue');   // WHERE chapterName = 'fooValue'
     * $query->filterByChaptername('%fooValue%', Criteria::LIKE); // WHERE chapterName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $chaptername The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function filterByChaptername($chaptername = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($chaptername)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChapterTableMap::COL_CHAPTERNAME, $chaptername, $comparison);
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
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function filterByBookBookid($bookBookid = null, $comparison = null)
    {
        if (is_array($bookBookid)) {
            $useMinMax = false;
            if (isset($bookBookid['min'])) {
                $this->addUsingAlias(ChapterTableMap::COL_BOOK_BOOKID, $bookBookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookBookid['max'])) {
                $this->addUsingAlias(ChapterTableMap::COL_BOOK_BOOKID, $bookBookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(ChapterTableMap::COL_BOOK_BOOKID, $bookBookid, $comparison);
    }

    /**
     * Filter the query by a related \Book object
     *
     * @param \Book|ObjectCollection $book The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildChapterQuery The current query, for fluid interface
     */
    public function filterByBook($book, $comparison = null)
    {
        if ($book instanceof \Book) {
            return $this
                ->addUsingAlias(ChapterTableMap::COL_BOOK_BOOKID, $book->getBookid(), $comparison);
        } elseif ($book instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(ChapterTableMap::COL_BOOK_BOOKID, $book->toKeyValue('PrimaryKey', 'Bookid'), $comparison);
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
     * @return $this|ChildChapterQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildChapter $chapter Object to remove from the list of results
     *
     * @return $this|ChildChapterQuery The current query, for fluid interface
     */
    public function prune($chapter = null)
    {
        if ($chapter) {
            $this->addUsingAlias(ChapterTableMap::COL_CHAPTERID, $chapter->getChapterid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the chapter table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(ChapterTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            ChapterTableMap::clearInstancePool();
            ChapterTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(ChapterTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(ChapterTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            ChapterTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            ChapterTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // ChapterQuery
