<?php

namespace Base;

use \Book as ChildBook;
use \BookQuery as ChildBookQuery;
use \Exception;
use \PDO;
use Map\BookTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'book' table.
 *
 *
 *
 * @method     ChildBookQuery orderByBookid($order = Criteria::ASC) Order by the bookID column
 * @method     ChildBookQuery orderByBookname($order = Criteria::ASC) Order by the bookName column
 * @method     ChildBookQuery orderByYearofrelease($order = Criteria::ASC) Order by the yearOfRelease column
 * @method     ChildBookQuery orderByBookdescription($order = Criteria::ASC) Order by the bookDescription column
 * @method     ChildBookQuery orderByIsbn($order = Criteria::ASC) Order by the ISBN column
 * @method     ChildBookQuery orderByBookimage($order = Criteria::ASC) Order by the bookImage column
 * @method     ChildBookQuery orderByAuthorAuthid1($order = Criteria::ASC) Order by the author_authID1 column
 *
 * @method     ChildBookQuery groupByBookid() Group by the bookID column
 * @method     ChildBookQuery groupByBookname() Group by the bookName column
 * @method     ChildBookQuery groupByYearofrelease() Group by the yearOfRelease column
 * @method     ChildBookQuery groupByBookdescription() Group by the bookDescription column
 * @method     ChildBookQuery groupByIsbn() Group by the ISBN column
 * @method     ChildBookQuery groupByBookimage() Group by the bookImage column
 * @method     ChildBookQuery groupByAuthorAuthid1() Group by the author_authID1 column
 *
 * @method     ChildBookQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildBookQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildBookQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildBookQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildBookQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildBookQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildBookQuery leftJoinAuthor($relationAlias = null) Adds a LEFT JOIN clause to the query using the Author relation
 * @method     ChildBookQuery rightJoinAuthor($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Author relation
 * @method     ChildBookQuery innerJoinAuthor($relationAlias = null) Adds a INNER JOIN clause to the query using the Author relation
 *
 * @method     ChildBookQuery joinWithAuthor($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Author relation
 *
 * @method     ChildBookQuery leftJoinWithAuthor() Adds a LEFT JOIN clause and with to the query using the Author relation
 * @method     ChildBookQuery rightJoinWithAuthor() Adds a RIGHT JOIN clause and with to the query using the Author relation
 * @method     ChildBookQuery innerJoinWithAuthor() Adds a INNER JOIN clause and with to the query using the Author relation
 *
 * @method     ChildBookQuery leftJoinBookinreadinglist($relationAlias = null) Adds a LEFT JOIN clause to the query using the Bookinreadinglist relation
 * @method     ChildBookQuery rightJoinBookinreadinglist($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Bookinreadinglist relation
 * @method     ChildBookQuery innerJoinBookinreadinglist($relationAlias = null) Adds a INNER JOIN clause to the query using the Bookinreadinglist relation
 *
 * @method     ChildBookQuery joinWithBookinreadinglist($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Bookinreadinglist relation
 *
 * @method     ChildBookQuery leftJoinWithBookinreadinglist() Adds a LEFT JOIN clause and with to the query using the Bookinreadinglist relation
 * @method     ChildBookQuery rightJoinWithBookinreadinglist() Adds a RIGHT JOIN clause and with to the query using the Bookinreadinglist relation
 * @method     ChildBookQuery innerJoinWithBookinreadinglist() Adds a INNER JOIN clause and with to the query using the Bookinreadinglist relation
 *
 * @method     ChildBookQuery leftJoinBooktagged($relationAlias = null) Adds a LEFT JOIN clause to the query using the Booktagged relation
 * @method     ChildBookQuery rightJoinBooktagged($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Booktagged relation
 * @method     ChildBookQuery innerJoinBooktagged($relationAlias = null) Adds a INNER JOIN clause to the query using the Booktagged relation
 *
 * @method     ChildBookQuery joinWithBooktagged($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Booktagged relation
 *
 * @method     ChildBookQuery leftJoinWithBooktagged() Adds a LEFT JOIN clause and with to the query using the Booktagged relation
 * @method     ChildBookQuery rightJoinWithBooktagged() Adds a RIGHT JOIN clause and with to the query using the Booktagged relation
 * @method     ChildBookQuery innerJoinWithBooktagged() Adds a INNER JOIN clause and with to the query using the Booktagged relation
 *
 * @method     ChildBookQuery leftJoinChapter($relationAlias = null) Adds a LEFT JOIN clause to the query using the Chapter relation
 * @method     ChildBookQuery rightJoinChapter($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Chapter relation
 * @method     ChildBookQuery innerJoinChapter($relationAlias = null) Adds a INNER JOIN clause to the query using the Chapter relation
 *
 * @method     ChildBookQuery joinWithChapter($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Chapter relation
 *
 * @method     ChildBookQuery leftJoinWithChapter() Adds a LEFT JOIN clause and with to the query using the Chapter relation
 * @method     ChildBookQuery rightJoinWithChapter() Adds a RIGHT JOIN clause and with to the query using the Chapter relation
 * @method     ChildBookQuery innerJoinWithChapter() Adds a INNER JOIN clause and with to the query using the Chapter relation
 *
 * @method     ChildBookQuery leftJoinUserrating($relationAlias = null) Adds a LEFT JOIN clause to the query using the Userrating relation
 * @method     ChildBookQuery rightJoinUserrating($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Userrating relation
 * @method     ChildBookQuery innerJoinUserrating($relationAlias = null) Adds a INNER JOIN clause to the query using the Userrating relation
 *
 * @method     ChildBookQuery joinWithUserrating($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Userrating relation
 *
 * @method     ChildBookQuery leftJoinWithUserrating() Adds a LEFT JOIN clause and with to the query using the Userrating relation
 * @method     ChildBookQuery rightJoinWithUserrating() Adds a RIGHT JOIN clause and with to the query using the Userrating relation
 * @method     ChildBookQuery innerJoinWithUserrating() Adds a INNER JOIN clause and with to the query using the Userrating relation
 *
 * @method     \AuthorQuery|\BookinreadinglistQuery|\BooktaggedQuery|\ChapterQuery|\UserratingQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildBook findOne(ConnectionInterface $con = null) Return the first ChildBook matching the query
 * @method     ChildBook findOneOrCreate(ConnectionInterface $con = null) Return the first ChildBook matching the query, or a new ChildBook object populated from the query conditions when no match is found
 *
 * @method     ChildBook findOneByBookid(int $bookID) Return the first ChildBook filtered by the bookID column
 * @method     ChildBook findOneByBookname(string $bookName) Return the first ChildBook filtered by the bookName column
 * @method     ChildBook findOneByYearofrelease(string $yearOfRelease) Return the first ChildBook filtered by the yearOfRelease column
 * @method     ChildBook findOneByBookdescription(string $bookDescription) Return the first ChildBook filtered by the bookDescription column
 * @method     ChildBook findOneByIsbn(string $ISBN) Return the first ChildBook filtered by the ISBN column
 * @method     ChildBook findOneByBookimage(string $bookImage) Return the first ChildBook filtered by the bookImage column
 * @method     ChildBook findOneByAuthorAuthid1(int $author_authID1) Return the first ChildBook filtered by the author_authID1 column *

 * @method     ChildBook requirePk($key, ConnectionInterface $con = null) Return the ChildBook by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOne(ConnectionInterface $con = null) Return the first ChildBook matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBook requireOneByBookid(int $bookID) Return the first ChildBook filtered by the bookID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByBookname(string $bookName) Return the first ChildBook filtered by the bookName column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByYearofrelease(string $yearOfRelease) Return the first ChildBook filtered by the yearOfRelease column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByBookdescription(string $bookDescription) Return the first ChildBook filtered by the bookDescription column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByIsbn(string $ISBN) Return the first ChildBook filtered by the ISBN column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByBookimage(string $bookImage) Return the first ChildBook filtered by the bookImage column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildBook requireOneByAuthorAuthid1(int $author_authID1) Return the first ChildBook filtered by the author_authID1 column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildBook[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildBook objects based on current ModelCriteria
 * @method     ChildBook[]|ObjectCollection findByBookid(int $bookID) Return ChildBook objects filtered by the bookID column
 * @method     ChildBook[]|ObjectCollection findByBookname(string $bookName) Return ChildBook objects filtered by the bookName column
 * @method     ChildBook[]|ObjectCollection findByYearofrelease(string $yearOfRelease) Return ChildBook objects filtered by the yearOfRelease column
 * @method     ChildBook[]|ObjectCollection findByBookdescription(string $bookDescription) Return ChildBook objects filtered by the bookDescription column
 * @method     ChildBook[]|ObjectCollection findByIsbn(string $ISBN) Return ChildBook objects filtered by the ISBN column
 * @method     ChildBook[]|ObjectCollection findByBookimage(string $bookImage) Return ChildBook objects filtered by the bookImage column
 * @method     ChildBook[]|ObjectCollection findByAuthorAuthid1(int $author_authID1) Return ChildBook objects filtered by the author_authID1 column
 * @method     ChildBook[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class BookQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\BookQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Book', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildBookQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildBookQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildBookQuery) {
            return $criteria;
        }
        $query = new ChildBookQuery();
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
     * @return ChildBook|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(BookTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = BookTableMap::getInstanceFromPool(null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key)))) {
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
     * @return ChildBook A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT bookID, bookName, yearOfRelease, bookDescription, ISBN, bookImage, author_authID1 FROM book WHERE bookID = :p0';
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
            /** @var ChildBook $obj */
            $obj = new ChildBook();
            $obj->hydrate($row);
            BookTableMap::addInstanceToPool($obj, null === $key || is_scalar($key) || is_callable([$key, '__toString']) ? (string) $key : $key);
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
     * @return ChildBook|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(BookTableMap::COL_BOOKID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(BookTableMap::COL_BOOKID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the bookID column
     *
     * Example usage:
     * <code>
     * $query->filterByBookid(1234); // WHERE bookID = 1234
     * $query->filterByBookid(array(12, 34)); // WHERE bookID IN (12, 34)
     * $query->filterByBookid(array('min' => 12)); // WHERE bookID > 12
     * </code>
     *
     * @param     mixed $bookid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByBookid($bookid = null, $comparison = null)
    {
        if (is_array($bookid)) {
            $useMinMax = false;
            if (isset($bookid['min'])) {
                $this->addUsingAlias(BookTableMap::COL_BOOKID, $bookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookid['max'])) {
                $this->addUsingAlias(BookTableMap::COL_BOOKID, $bookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_BOOKID, $bookid, $comparison);
    }

    /**
     * Filter the query on the bookName column
     *
     * Example usage:
     * <code>
     * $query->filterByBookname('fooValue');   // WHERE bookName = 'fooValue'
     * $query->filterByBookname('%fooValue%', Criteria::LIKE); // WHERE bookName LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bookname The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *;
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByBookname($bookname = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bookname)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_BOOKNAME, $bookname, $comparison);
    }

    /**
     * Filter the query on the yearOfRelease column
     *
     * Example usage:
     * <code>
     * $query->filterByYearofrelease('2011-03-14'); // WHERE yearOfRelease = '2011-03-14'
     * $query->filterByYearofrelease('now'); // WHERE yearOfRelease = '2011-03-14'
     * $query->filterByYearofrelease(array('max' => 'yesterday')); // WHERE yearOfRelease > '2011-03-13'
     * </code>
     *
     * @param     mixed $yearofrelease The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByYearofrelease($yearofrelease = null, $comparison = null)
    {
        if (is_array($yearofrelease)) {
            $useMinMax = false;
            if (isset($yearofrelease['min'])) {
                $this->addUsingAlias(BookTableMap::COL_YEAROFRELEASE, $yearofrelease['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($yearofrelease['max'])) {
                $this->addUsingAlias(BookTableMap::COL_YEAROFRELEASE, $yearofrelease['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_YEAROFRELEASE, $yearofrelease, $comparison);
    }

    /**
     * Filter the query on the bookDescription column
     *
     * Example usage:
     * <code>
     * $query->filterByBookdescription('fooValue');   // WHERE bookDescription = 'fooValue'
     * $query->filterByBookdescription('%fooValue%', Criteria::LIKE); // WHERE bookDescription LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bookdescription The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByBookdescription($bookdescription = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bookdescription)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_BOOKDESCRIPTION, $bookdescription, $comparison);
    }

    /**
     * Filter the query on the ISBN column
     *
     * Example usage:
     * <code>
     * $query->filterByIsbn('fooValue');   // WHERE ISBN = 'fooValue'
     * $query->filterByIsbn('%fooValue%', Criteria::LIKE); // WHERE ISBN LIKE '%fooValue%'
     * </code>
     *
     * @param     string $isbn The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByIsbn($isbn = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($isbn)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_ISBN, $isbn, $comparison);
    }

    /**
     * Filter the query on the bookImage column
     *
     * Example usage:
     * <code>
     * $query->filterByBookimage('fooValue');   // WHERE bookImage = 'fooValue'
     * $query->filterByBookimage('%fooValue%', Criteria::LIKE); // WHERE bookImage LIKE '%fooValue%'
     * </code>
     *
     * @param     string $bookimage The value to use as filter.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByBookimage($bookimage = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($bookimage)) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_BOOKIMAGE, $bookimage, $comparison);
    }

    /**
     * Filter the query on the author_authID1 column
     *
     * Example usage:
     * <code>
     * $query->filterByAuthorAuthid1(1234); // WHERE author_authID1 = 1234
     * $query->filterByAuthorAuthid1(array(12, 34)); // WHERE author_authID1 IN (12, 34)
     * $query->filterByAuthorAuthid1(array('min' => 12)); // WHERE author_authID1 > 12
     * </code>
     *
     * @see       filterByAuthor()
     *
     * @param     mixed $authorAuthid1 The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function filterByAuthorAuthid1($authorAuthid1 = null, $comparison = null)
    {
        if (is_array($authorAuthid1)) {
            $useMinMax = false;
            if (isset($authorAuthid1['min'])) {
                $this->addUsingAlias(BookTableMap::COL_AUTHOR_AUTHID1, $authorAuthid1['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($authorAuthid1['max'])) {
                $this->addUsingAlias(BookTableMap::COL_AUTHOR_AUTHID1, $authorAuthid1['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(BookTableMap::COL_AUTHOR_AUTHID1, $authorAuthid1, $comparison);
    }

    /**
     * Filter the query by a related \Author object
     *
     * @param \Author|ObjectCollection $author The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildBookQuery The current query, for fluid interface
     */
    public function filterByAuthor($author, $comparison = null)
    {
        if ($author instanceof \Author) {
            return $this
                ->addUsingAlias(BookTableMap::COL_AUTHOR_AUTHID1, $author->getAuthid(), $comparison);
        } elseif ($author instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(BookTableMap::COL_AUTHOR_AUTHID1, $author->toKeyValue('PrimaryKey', 'Authid'), $comparison);
        } else {
            throw new PropelException('filterByAuthor() only accepts arguments of type \Author or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Author relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function joinAuthor($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Author');

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
            $this->addJoinObject($join, 'Author');
        }

        return $this;
    }

    /**
     * Use the Author relation Author object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \AuthorQuery A secondary query class using the current class as primary query
     */
    public function useAuthorQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinAuthor($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Author', '\AuthorQuery');
    }

    /**
     * Filter the query by a related \Bookinreadinglist object
     *
     * @param \Bookinreadinglist|ObjectCollection $bookinreadinglist the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookQuery The current query, for fluid interface
     */
    public function filterByBookinreadinglist($bookinreadinglist, $comparison = null)
    {
        if ($bookinreadinglist instanceof \Bookinreadinglist) {
            return $this
                ->addUsingAlias(BookTableMap::COL_BOOKID, $bookinreadinglist->getBookBookid(), $comparison);
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
     * @return $this|ChildBookQuery The current query, for fluid interface
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
     * Filter the query by a related \Booktagged object
     *
     * @param \Booktagged|ObjectCollection $booktagged the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookQuery The current query, for fluid interface
     */
    public function filterByBooktagged($booktagged, $comparison = null)
    {
        if ($booktagged instanceof \Booktagged) {
            return $this
                ->addUsingAlias(BookTableMap::COL_BOOKID, $booktagged->getBookBookid(), $comparison);
        } elseif ($booktagged instanceof ObjectCollection) {
            return $this
                ->useBooktaggedQuery()
                ->filterByPrimaryKeys($booktagged->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByBooktagged() only accepts arguments of type \Booktagged or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Booktagged relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function joinBooktagged($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Booktagged');

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
            $this->addJoinObject($join, 'Booktagged');
        }

        return $this;
    }

    /**
     * Use the Booktagged relation Booktagged object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \BooktaggedQuery A secondary query class using the current class as primary query
     */
    public function useBooktaggedQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinBooktagged($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Booktagged', '\BooktaggedQuery');
    }

    /**
     * Filter the query by a related \Chapter object
     *
     * @param \Chapter|ObjectCollection $chapter the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookQuery The current query, for fluid interface
     */
    public function filterByChapter($chapter, $comparison = null)
    {
        if ($chapter instanceof \Chapter) {
            return $this
                ->addUsingAlias(BookTableMap::COL_BOOKID, $chapter->getBookBookid(), $comparison);
        } elseif ($chapter instanceof ObjectCollection) {
            return $this
                ->useChapterQuery()
                ->filterByPrimaryKeys($chapter->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByChapter() only accepts arguments of type \Chapter or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Chapter relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function joinChapter($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Chapter');

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
            $this->addJoinObject($join, 'Chapter');
        }

        return $this;
    }

    /**
     * Use the Chapter relation Chapter object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ChapterQuery A secondary query class using the current class as primary query
     */
    public function useChapterQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinChapter($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Chapter', '\ChapterQuery');
    }

    /**
     * Filter the query by a related \Userrating object
     *
     * @param \Userrating|ObjectCollection $userrating the related object to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return ChildBookQuery The current query, for fluid interface
     */
    public function filterByUserrating($userrating, $comparison = null)
    {
        if ($userrating instanceof \Userrating) {
            return $this
                ->addUsingAlias(BookTableMap::COL_BOOKID, $userrating->getBookBookid(), $comparison);
        } elseif ($userrating instanceof ObjectCollection) {
            return $this
                ->useUserratingQuery()
                ->filterByPrimaryKeys($userrating->getPrimaryKeys())
                ->endUse();
        } else {
            throw new PropelException('filterByUserrating() only accepts arguments of type \Userrating or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Userrating relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function joinUserrating($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Userrating');

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
            $this->addJoinObject($join, 'Userrating');
        }

        return $this;
    }

    /**
     * Use the Userrating relation Userrating object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UserratingQuery A secondary query class using the current class as primary query
     */
    public function useUserratingQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUserrating($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Userrating', '\UserratingQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildBook $book Object to remove from the list of results
     *
     * @return $this|ChildBookQuery The current query, for fluid interface
     */
    public function prune($book = null)
    {
        if ($book) {
            $this->addUsingAlias(BookTableMap::COL_BOOKID, $book->getBookid(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the book table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(BookTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            BookTableMap::clearInstancePool();
            BookTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(BookTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(BookTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            BookTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            BookTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // BookQuery
