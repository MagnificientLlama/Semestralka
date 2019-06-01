<?php

namespace Base;

use \Userrating as ChildUserrating;
use \UserratingQuery as ChildUserratingQuery;
use \Exception;
use \PDO;
use Map\UserratingTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'userrating' table.
 *
 *
 *
 * @method     ChildUserratingQuery orderByRatingid($order = Criteria::ASC) Order by the ratingID column
 * @method     ChildUserratingQuery orderByRating($order = Criteria::ASC) Order by the rating column
 * @method     ChildUserratingQuery orderByUserUserid($order = Criteria::ASC) Order by the user_userID column
 * @method     ChildUserratingQuery orderByBookBookid($order = Criteria::ASC) Order by the book_bookID column
 *
 * @method     ChildUserratingQuery groupByRatingid() Group by the ratingID column
 * @method     ChildUserratingQuery groupByRating() Group by the rating column
 * @method     ChildUserratingQuery groupByUserUserid() Group by the user_userID column
 * @method     ChildUserratingQuery groupByBookBookid() Group by the book_bookID column
 *
 * @method     ChildUserratingQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildUserratingQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildUserratingQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildUserratingQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildUserratingQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildUserratingQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildUserratingQuery leftJoinBook($relationAlias = null) Adds a LEFT JOIN clause to the query using the Book relation
 * @method     ChildUserratingQuery rightJoinBook($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Book relation
 * @method     ChildUserratingQuery innerJoinBook($relationAlias = null) Adds a INNER JOIN clause to the query using the Book relation
 *
 * @method     ChildUserratingQuery joinWithBook($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Book relation
 *
 * @method     ChildUserratingQuery leftJoinWithBook() Adds a LEFT JOIN clause and with to the query using the Book relation
 * @method     ChildUserratingQuery rightJoinWithBook() Adds a RIGHT JOIN clause and with to the query using the Book relation
 * @method     ChildUserratingQuery innerJoinWithBook() Adds a INNER JOIN clause and with to the query using the Book relation
 *
 * @method     ChildUserratingQuery leftJoinUser($relationAlias = null) Adds a LEFT JOIN clause to the query using the User relation
 * @method     ChildUserratingQuery rightJoinUser($relationAlias = null) Adds a RIGHT JOIN clause to the query using the User relation
 * @method     ChildUserratingQuery innerJoinUser($relationAlias = null) Adds a INNER JOIN clause to the query using the User relation
 *
 * @method     ChildUserratingQuery joinWithUser($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the User relation
 *
 * @method     ChildUserratingQuery leftJoinWithUser() Adds a LEFT JOIN clause and with to the query using the User relation
 * @method     ChildUserratingQuery rightJoinWithUser() Adds a RIGHT JOIN clause and with to the query using the User relation
 * @method     ChildUserratingQuery innerJoinWithUser() Adds a INNER JOIN clause and with to the query using the User relation
 *
 * @method     \BookQuery|\UserQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildUserrating findOne(ConnectionInterface $con = null) Return the first ChildUserrating matching the query
 * @method     ChildUserrating findOneOrCreate(ConnectionInterface $con = null) Return the first ChildUserrating matching the query, or a new ChildUserrating object populated from the query conditions when no match is found
 *
 * @method     ChildUserrating findOneByRatingid(int $ratingID) Return the first ChildUserrating filtered by the ratingID column
 * @method     ChildUserrating findOneByRating(int $rating) Return the first ChildUserrating filtered by the rating column
 * @method     ChildUserrating findOneByUserUserid(int $user_userID) Return the first ChildUserrating filtered by the user_userID column
 * @method     ChildUserrating findOneByBookBookid(int $book_bookID) Return the first ChildUserrating filtered by the book_bookID column *

 * @method     ChildUserrating requirePk($key, ConnectionInterface $con = null) Return the ChildUserrating by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserrating requireOne(ConnectionInterface $con = null) Return the first ChildUserrating matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserrating requireOneByRatingid(int $ratingID) Return the first ChildUserrating filtered by the ratingID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserrating requireOneByRating(int $rating) Return the first ChildUserrating filtered by the rating column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserrating requireOneByUserUserid(int $user_userID) Return the first ChildUserrating filtered by the user_userID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildUserrating requireOneByBookBookid(int $book_bookID) Return the first ChildUserrating filtered by the book_bookID column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildUserrating[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildUserrating objects based on current ModelCriteria
 * @method     ChildUserrating[]|ObjectCollection findByRatingid(int $ratingID) Return ChildUserrating objects filtered by the ratingID column
 * @method     ChildUserrating[]|ObjectCollection findByRating(int $rating) Return ChildUserrating objects filtered by the rating column
 * @method     ChildUserrating[]|ObjectCollection findByUserUserid(int $user_userID) Return ChildUserrating objects filtered by the user_userID column
 * @method     ChildUserrating[]|ObjectCollection findByBookBookid(int $book_bookID) Return ChildUserrating objects filtered by the book_bookID column
 * @method     ChildUserrating[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class UserratingQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\UserratingQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Userrating', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildUserratingQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildUserratingQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildUserratingQuery) {
            return $criteria;
        }
        $query = new ChildUserratingQuery();
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
     * $obj = $c->findPk(array(12, 34, 56), $con);
     * </code>
     *
     * @param array[$ratingID, $user_userID, $book_bookID] $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildUserrating|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(UserratingTableMap::DATABASE_NAME);
        }

        $this->basePreSelect($con);

        if (
            $this->formatter || $this->modelAlias || $this->with || $this->select
            || $this->selectColumns || $this->asColumns || $this->selectModifiers
            || $this->map || $this->having || $this->joins
        ) {
            return $this->findPkComplex($key, $con);
        }

        if ((null !== ($obj = UserratingTableMap::getInstanceFromPool(serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]))))) {
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
     * @return ChildUserrating A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT ratingID, rating, user_userID, book_bookID FROM userrating WHERE ratingID = :p0 AND user_userID = :p1 AND book_bookID = :p2';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key[0], PDO::PARAM_INT);
            $stmt->bindValue(':p1', $key[1], PDO::PARAM_INT);
            $stmt->bindValue(':p2', $key[2], PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildUserrating $obj */
            $obj = new ChildUserrating();
            $obj->hydrate($row);
            UserratingTableMap::addInstanceToPool($obj, serialize([(null === $key[0] || is_scalar($key[0]) || is_callable([$key[0], '__toString']) ? (string) $key[0] : $key[0]), (null === $key[1] || is_scalar($key[1]) || is_callable([$key[1], '__toString']) ? (string) $key[1] : $key[1]), (null === $key[2] || is_scalar($key[2]) || is_callable([$key[2], '__toString']) ? (string) $key[2] : $key[2])]));
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
     * @return ChildUserrating|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {
        $this->addUsingAlias(UserratingTableMap::COL_RATINGID, $key[0], Criteria::EQUAL);
        $this->addUsingAlias(UserratingTableMap::COL_USER_USERID, $key[1], Criteria::EQUAL);
        $this->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $key[2], Criteria::EQUAL);

        return $this;
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {
        if (empty($keys)) {
            return $this->add(null, '1<>1', Criteria::CUSTOM);
        }
        foreach ($keys as $key) {
            $cton0 = $this->getNewCriterion(UserratingTableMap::COL_RATINGID, $key[0], Criteria::EQUAL);
            $cton1 = $this->getNewCriterion(UserratingTableMap::COL_USER_USERID, $key[1], Criteria::EQUAL);
            $cton0->addAnd($cton1);
            $cton2 = $this->getNewCriterion(UserratingTableMap::COL_BOOK_BOOKID, $key[2], Criteria::EQUAL);
            $cton0->addAnd($cton2);
            $this->addOr($cton0);
        }

        return $this;
    }

    /**
     * Filter the query on the ratingID column
     *
     * Example usage:
     * <code>
     * $query->filterByRatingid(1234); // WHERE ratingID = 1234
     * $query->filterByRatingid(array(12, 34)); // WHERE ratingID IN (12, 34)
     * $query->filterByRatingid(array('min' => 12)); // WHERE ratingID > 12
     * </code>
     *
     * @param     mixed $ratingid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByRatingid($ratingid = null, $comparison = null)
    {
        if (is_array($ratingid)) {
            $useMinMax = false;
            if (isset($ratingid['min'])) {
                $this->addUsingAlias(UserratingTableMap::COL_RATINGID, $ratingid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($ratingid['max'])) {
                $this->addUsingAlias(UserratingTableMap::COL_RATINGID, $ratingid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserratingTableMap::COL_RATINGID, $ratingid, $comparison);
    }

    /**
     * Filter the query on the rating column
     *
     * Example usage:
     * <code>
     * $query->filterByRating(1234); // WHERE rating = 1234
     * $query->filterByRating(array(12, 34)); // WHERE rating IN (12, 34)
     * $query->filterByRating(array('min' => 12)); // WHERE rating > 12
     * </code>
     *
     * @param     mixed $rating The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByRating($rating = null, $comparison = null)
    {
        if (is_array($rating)) {
            $useMinMax = false;
            if (isset($rating['min'])) {
                $this->addUsingAlias(UserratingTableMap::COL_RATING, $rating['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($rating['max'])) {
                $this->addUsingAlias(UserratingTableMap::COL_RATING, $rating['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserratingTableMap::COL_RATING, $rating, $comparison);
    }

    /**
     * Filter the query on the user_userID column
     *
     * Example usage:
     * <code>
     * $query->filterByUserUserid(1234); // WHERE user_userID = 1234
     * $query->filterByUserUserid(array(12, 34)); // WHERE user_userID IN (12, 34)
     * $query->filterByUserUserid(array('min' => 12)); // WHERE user_userID > 12
     * </code>
     *
     * @see       filterByUser()
     *
     * @param     mixed $userUserid The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByUserUserid($userUserid = null, $comparison = null)
    {
        if (is_array($userUserid)) {
            $useMinMax = false;
            if (isset($userUserid['min'])) {
                $this->addUsingAlias(UserratingTableMap::COL_USER_USERID, $userUserid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($userUserid['max'])) {
                $this->addUsingAlias(UserratingTableMap::COL_USER_USERID, $userUserid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserratingTableMap::COL_USER_USERID, $userUserid, $comparison);
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
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByBookBookid($bookBookid = null, $comparison = null)
    {
        if (is_array($bookBookid)) {
            $useMinMax = false;
            if (isset($bookBookid['min'])) {
                $this->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $bookBookid['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($bookBookid['max'])) {
                $this->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $bookBookid['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $bookBookid, $comparison);
    }

    /**
     * Filter the query by a related \Book object
     *
     * @param \Book|ObjectCollection $book The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByBook($book, $comparison = null)
    {
        if ($book instanceof \Book) {
            return $this
                ->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $book->getBookid(), $comparison);
        } elseif ($book instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserratingTableMap::COL_BOOK_BOOKID, $book->toKeyValue('PrimaryKey', 'Bookid'), $comparison);
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
     * @return $this|ChildUserratingQuery The current query, for fluid interface
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
     * Filter the query by a related \User object
     *
     * @param \User|ObjectCollection $user The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildUserratingQuery The current query, for fluid interface
     */
    public function filterByUser($user, $comparison = null)
    {
        if ($user instanceof \User) {
            return $this
                ->addUsingAlias(UserratingTableMap::COL_USER_USERID, $user->getUserid(), $comparison);
        } elseif ($user instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(UserratingTableMap::COL_USER_USERID, $user->toKeyValue('PrimaryKey', 'Userid'), $comparison);
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
     * @return $this|ChildUserratingQuery The current query, for fluid interface
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
     * Exclude object from result
     *
     * @param   ChildUserrating $userrating Object to remove from the list of results
     *
     * @return $this|ChildUserratingQuery The current query, for fluid interface
     */
    public function prune($userrating = null)
    {
        if ($userrating) {
            $this->addCond('pruneCond0', $this->getAliasedColName(UserratingTableMap::COL_RATINGID), $userrating->getRatingid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond1', $this->getAliasedColName(UserratingTableMap::COL_USER_USERID), $userrating->getUserUserid(), Criteria::NOT_EQUAL);
            $this->addCond('pruneCond2', $this->getAliasedColName(UserratingTableMap::COL_BOOK_BOOKID), $userrating->getBookBookid(), Criteria::NOT_EQUAL);
            $this->combine(array('pruneCond0', 'pruneCond1', 'pruneCond2'), Criteria::LOGICAL_OR);
        }

        return $this;
    }

    /**
     * Deletes all rows from the userrating table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(UserratingTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            UserratingTableMap::clearInstancePool();
            UserratingTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(UserratingTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(UserratingTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            UserratingTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            UserratingTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // UserratingQuery
